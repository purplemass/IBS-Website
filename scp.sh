#!/bin/sh
##################################################################################################
# ftp.sh 
# written by bhat 08.07.2009
# script to secure copy (scp) files to imagination-digital server
# this script must reside in the root of your git project
# run this *before* you commit

##################################################################################################
# vars - change!
username='ibsproject.org'
server="ftp.ibsproject.org"
server_path="/"

##################################################################################################
# vars - do not change
os_users='dct'
id_path="/Users/$os_users/.ssh/$os_users"
#files=`git diff --cached --name-only`
files=`git diff --name-only`
res="Q"

##################################################################################################
# print message
clear
echo "Hello $USER"
echo "We are going to secure copy the following file(s):"
echo
for s in ${files[@]}; do
    echo "->" $s
done

echo

##################################################################################################
# LOOP

#--------------------------------------------------------------
for myfile in $files
do

#--------------------------------------------------------------
# get file path
filename=`expr //$myfile : '.*/\(.*\)'`
n1=${#filename}
n2=${#myfile}
n3=`expr $n2 - $n1`
file_path=${myfile:0:$n3}

#--------------------------------------------------------------
# awk - ignore
#echo `expr index "$myfile" C12`
#echo `expr index "$myfile" ass`
#n=`echo $myfile | awk '{ print index($0,"/") }'`
#file_path=`echo $myfile $n | awk '{ print substr( $1, 0, $2 ) }'` #length($1)

# ignore
# split into myArray
#echo {myAray[@]}
#echo ${#files}
#length=${#files[*]}

#echo "Today is \c ";date
#echo "Number of user login : \c" ; who | wc -l


#--------------------------------------------------------------
# create command
#cmd="scp -i $id_path $myfile $username@$server:$server_path$file_path"
cmd="ftp -i $id_path $myfile $username@$server:$server_path$file_path"

#--------------------------------------------------------------
# print copy message
if [ $res == "Q" ]
then
echo "Copy file '$myfile'? (y/n/a/x)"
read res
fi

#--------------------------------------------------------------
if [ $res == "y" ]
then
#echo $cmd
$cmd
res="Q"
elif [ $res == "n" ]
then
res="Q"
elif [ $res == "a" ]
then
#echo $cmd
$cmd
elif [ $res == "x" ]
then
exit 0
fi

#--------------------------------------------------------------
#echo "RESPONSE:" $?
echo

#--------------------------------------------------------------
done

##################################################################################################
# message
echo
echo "DONE!"
echo

# end