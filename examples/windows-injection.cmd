@echo off
:setup
	setlocal
	set wsoperatorurl=http://name-or-ipaddress/wsoperator

:phonehome
	rem
	rem Sample script to phone home to wsoperator for insturctions.
	rem The target locations are coded for SteadierState path of c:\srs\wsoperator
	rem
	rem First get the machines mac address for phone home
	for /f %%a in ('getmac /NH') do (
		set mymac=%%a
		goto :stopnow
	)
	:stopnow

	rem We now should have the mac address in the mymac variable and we can call the wsoperator
	rem Make sure the target folder exists and if not create it
	if not exist c:\srs\wsoperator md c:\srs\wsoperator
	bitsadmin /transfer myjob /download /priority high %wsoperatorurl%/operator.php?mac=%mymac% c:\srs\wsoperator\scripts.txt

	rem The below reads the line of instructions allowing the for loop to walk through list of commands
	set /p wsscripts=<c:\srs\wsoperator\scripts.txt
	rem Now step through the scripts assigned to the workstation
	for %%c in (%wsscripts%) do (
		for /f "delims=/ tokens=3" %%d in ('echo %%c') do (
			rem echo Attempting to download %wsoperatorurl%/machines/%%c and execute c:\srs\wsoperator\%%d
			bitsadmin /transfer %%d /download /priority high %wsoperatorurl%/machines/%%c c:\srs\wsoperator\%%d.cmd&c:\srs\wsoperator\%%d.cmd
			rem pause
		)
	)

:goodend
	rem
	rem Success
	rem
	echo.
	echo Phone home appears to have completed successfully!
	goto :end

:badend
	rem
	rem Something failed
	rem
	echo.
	echo Please check the output for information which might help you
	echo figure out what went wrong.

:end
	rem
	rem Final message before exiting phone home
	rem
	endlocal
	echo.
