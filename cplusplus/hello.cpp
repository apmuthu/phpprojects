#include <iostream>
 
int main()
{
    using namespace std;
    cout << "Hello world!" << endl;

//    system("PAUSE"); // Windows Only
//    system("read -p \"Press a key to continue...\" -n 1 -s"); // Linux Only

/*
Don't use system("anything"). 
	It is slow. 
	It is disliked by antivirus software. 
	It is OS-dependent. 
	It tags you as an absolute beginner. 
	And it is a massively huge, gaping, ugly security hole.
*/
    
    cout << "Press a key to exit...";
    getchar(); // One way to fall through

    cout << endl << "Bye!";
    cin.get(); // another way to fall through

    return 0;
}
