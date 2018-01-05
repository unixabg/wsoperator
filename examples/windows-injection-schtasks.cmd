@echo off
:setup
	setlocal

:phonehomeschtasks
	rem
	rem Sample script to schedule task for the phone home to wsoperator script
	rem The target locations are coded for SteadierState path of c:\srs\wsoperator
	rem

	rem Make sure the target folder exists and if not goto badend
	if not exist c:\srs\wsoperator goto :badend

	rem Next make sure the target cmd exists and if not goto badend
	if not exist c:\srs\wsoperator\windows-injection.cmd goto :badend

	rem All seem well so schedule the task for windows-injection.cmd
	schtasks /Create /RU "NT AUTHORITY\SYSTEM" /SC ONSTART /TN windows-injection /TR c:\srs\wsoperator\windows-injection.cmd /F

:goodend
	rem
	rem Success
	rem
	echo.
	echo Phone home task appears to have been scheduled successfully!
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
	rem Final message before exiting phone home schedule
	rem
	endlocal
	echo.
