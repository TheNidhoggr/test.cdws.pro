<?
if (!SITE_ROOT) die("This script must be called");
class Auth
{
    private static $rootPasswordHash = "32bbf1db31daba72868385114e6b9078";
    public static $error = false;
    
    public function Error() {
        $result = $_SESSION["auth_last_error"];
        $_SESSION["auth_last_error"] = false;
        self::$error = false;
        return $result;
    }
    
    public function isAuthorized() {
        return $_SESSION["auth_isauthorized"];
    }
    
    public function AuthForm($template = "default") {
        Atom("auth.form", $template);
    }
    
    public function Authenticate() {
        global $connect;
        if (onPost("login") == "root") {
            $password = hash("md5", onPost("login") . hash("md5", onPost("password")));
            if ($password == self::$rootPasswordHash) {
                $_SESSION["auth_login"] = onPost("login");
                $_SESSION["auth_groupid"] = '0';
                $_SESSION["auth_isauthorized"] = true;
            } else {
                self::SetError(0);
            }
            return;
        }
        $user = $connect->real_escape_string(onPost("login"));
        $password = $connect->real_escape_string(onPost("password"));
        $query = "SELECT * FROM `users` WHERE `login` = '".$user."'";
        $rsUser = $connect->query($query);
        if ($rsUser->num_rows == 0) {
            self::SetError(1);
        } else {
            // Continue auth
        }
    }
    
    private function SetError($errCode) {
        $_SESSION["auth_last_error"] = "AUTH_ERROR_" . $errCode;
        self::$error = true;
    }
    
    public function ShowError() {
        if (self::$error == true) {
            echo "<div onclick=\"this.parentNode.removeChild(this)\" class=\"msg error\">".self::Error()."</div>";
        }
    }
    
    public function SignOut() {
        $_SESSION["auth_login"] = false;
        $_SESSION["auth_groupid"] = false;
        $_SESSION["auth_isauthorized"] = false;
    }
}

if (onGet("signout") == "1") {
    Auth::SignOut();
}
if (onPost("login")) {
    Auth::Authenticate();
}