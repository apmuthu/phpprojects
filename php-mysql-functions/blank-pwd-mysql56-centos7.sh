#! /bin/sh
#
# Author: Bert Van Vreckem <bert.vanvreckem@gmail.com>, Ap.Muthu
# https://github.com/bertvv/scripts/blob/master/src/secure-mysql.sh
# A non-interactive replacement for blanking mysql root password
#
# Tested on CentOS 6, CentOS 7, Ubuntu 12.04 LTS (Precise Pangolin), Ubuntu
# 14.04 LTS (Trusty Tahr).

set -o errexit # abort on nonzero exitstatus
set -o nounset # abort on unbound variable

#{{{ Functions

usage() {
cat << _EOF_

Usage: ${0} "ROOT PASSWORD"

  with "ROOT PASSWORD" the existing password for the database root user.

Use quotes if your password contains spaces or other special characters.
_EOF_
}

# Predicate that returns exit status 0 if the mysql(1) command is available,
# nonzero exit status otherwise.
is_mysql_command_available() {
  which mysql > /dev/null 2>&1
}

#}}}
#{{{ Command line parsing

if [ "$#" -ne "1" ]; then
  echo "Expected 1 argument, got $#" >&2
  usage
  exit 2
fi

#}}}
#{{{ Variables
db_root_password="${1}"
#}}}

# Script proper

if ! is_mysql_command_available; then
  echo "The MySQL/MariaDB client mysql(1) is not installed."
  exit 1
fi

mysql --user=root --password=${db_root_password}  <<_EOF_
  UPDATE mysql.user SET Password=PASSWORD('') WHERE User='root';
  DELETE FROM mysql.user WHERE User='';
  DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
  DROP DATABASE IF EXISTS test;
  DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
  FLUSH PRIVILEGES;
_EOF_

echo "Database root password blanked successfully"

config=/root/.my.cnf
if [ -f $config ]; then
  rm -f $config
  echo "MySQL root user auto login file $config removed"
fi


