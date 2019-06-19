# From the PHP Manual on phpinfo()
Outputs a large amount of information about the current state of PHP. This includes information about PHP compilation options and extensions, the PHP version, server information and environment (if compiled as a module), the PHP environment, OS version information, paths, master and local values of configuration options, HTTP headers, and the PHP License.

**phpinfo()** does more than just printing out php.ini settings.

# Processing / Comparing php.ini files across servers
If you want to process **php.ini** settings manually, you might want to check out **ini_get_all()** instead of **phpinfo()**. This returns an array of all configuration values.

You could transfer the output of **ini_get_all()** from server A to server B (for example by using **var_export()** to create PHP code to create the array, or **serialize()**), then use **array_diff_assoc()** to compare the settings.

* [Reference](https://stackoverflow.com/questions/1623681/comparing-2-phpinfo-settings)
