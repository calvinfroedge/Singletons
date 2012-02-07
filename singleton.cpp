#include <iostream>
#include <thread.h>

using namespace std;

class Singleton
{
	public:
		static int val_;
		static Singleton* instance() {
			if( val_ == 0 ) {
				lock_mutex();
				if(p_instance == 0)
					new Singleton;
				unlock_mutex();
				MEMORY_BARRIER();
				val_ = 1;
				return p_instance;
			}
			else {
				return p_instance;
			}
		}

		void setMember(string& newState) {
			m_member = newState;
		}

		string getMember() {
			return m_member;
		}

	private:
		Singleton(){}

		static Singleton* p_instance;
		
		string m_member;
};

Singleton* Singleton::p_instance = 0;

int main()
{
	string newState = "active";
	Singleton::instance()->setMember(newState);
	cout << "Member has been set to:" << Singleton::instance()->getMember() << "\n";
	return 0;
}
