import math
t=open('page.txt', 'w')
t.write('Hello. Okay.')
t.close()

t=open('page.txt', 'a')
t.write("\nValue of Pi is ")
t.write(repr(math.pi)) # repr converts float to string
pi=math.pi
t.write("\nValue of formatted Pi is: {}".format(pi))
print("\nWriting to file now.")
t.close();



