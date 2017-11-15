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

// will give time to examine program output before console window closes.
	cin.clear();
//	cin.ignore(255, '\n');
    cin.get(); // another way to fall through

/*
std::cin.ignore() can be called three different ways:

    No arguments: A single character is taken from the input buffer and discarded:
    std::cin.ignore(); //discard 1 character
    One argument: The number of characters specified are taken from the input buffer and discarded:
    std::cin.ignore(33); //discard 33 characters
    Two arguments: discard the number of characters specified, or discard characters up to and including the specified delimiter (whichever comes first):
    std::cin.ignore(26, '\n'); //ignore 26 characters or to a newline, whichever comes first
*/

    return 0;
}
