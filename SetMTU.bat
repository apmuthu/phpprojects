REM https://cyberraiden.wordpress.com/2023/06/20/how-to-configure-optimal-mtu-value-in-windows-10-11-os-using-powershell/
REM https://www.thewindowsclub.com/how-to-change-mtu-on-windows
REM Optimise MTU
REM ping thewindowsclub.com -f -l 1444
REM keep reducing above from 1500 in steps of 4 till defragment message goes away
netsh interface ipv4 show subinterfaces
netsh interface ipv4 set subinterface "vEthernet (Host NIC)" mtu=1444 store=persistent


