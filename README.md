# lib_CI_IVAOUSER
the Ivaouser helper library to CodeIgniter framework software

###Installation
1. Place Ivaouser.php in your application/libraries folder
2. Add 'ivaouser' to autoload.php in array with libraries:
    
    `$autoload['libraries'] = array('session',...,'ivaouser',...);`

3. Use it as provide in example

###Methods
  `setToken($token)` - tells library for a user token of IVAO LOGIN API
  
  `checkLoggedIn()` - checks if session has 'ivaodata' key
  
  `login()` - trying to login user with setted token. returns 0 or 1
  
  `generateLoginUrl($route)` - generates url for retreive token. You MUST provide 'base_url' in config. As $route - you should pass the route in your application to receive the ivaotoken from IVAO API
  
###Example:
the default (Welcome) controller:
```
    public function index()
	{
        if($this->ivaouser->checkLoggedIn()){
            $this->redirect('/pilot');
        }
        else{
            $this->redirect('/login');
        }
	}
	private function redirect($url){
        header("Refresh:0; url=".$url);
    }
```
the Login.php controller:
```
    public function index()
    {
        if($ivaotoken = $this->input->get('IVAOTOKEN')){
            $iu = $this->ivaouser;
            $iu->setToken($ivaotoken);
            if($iu->login()){
                $this->redirect('/pilot');
            }
            throw new HttpException("Not authorized",401);
        }
        $this->load->view('login_form');
    }
    private function redirect($url){
        header("Refresh:0; url=".$url);
    }
```
the Pilot.php controller:
```
    public function index()
    {
        var_dump($this->session->ivaodata);
    }
```
