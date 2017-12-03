<?
if (!SITE_ROOT) die("This script must be called");
class IMsg
{
    function Success($message = "Success") {
        $msg = "<div
            style='
                background-color: rgb(66,176,0);
                color: white;
                border-radius: 5px;
                padding: 15px;
                margin: 10px 0;
            '
            onclick='
                this.parentNode.removeChild(this);
            '
        >";
        $msg .= $message;
        $msg .= "</div>";
        echo $msg;
    }
    function Error($message = "Error") {
        $msg = "<div
            style='
                background-color: rgb(205,5,0);
                color: white;
                border-radius: 5px;
                padding: 15px;
                margin: 10px 0;
            '
            onclick='
                this.parentNode.removeChild(this);
            '
        >";
        $msg .= $message;
        $msg .= "</div>";
        echo $msg;
    }
    function Warning($message = "Warning") {
        $msg = "<div
            style='
                background-color: rgb(246,244,0);
                color: #000000;
                border-radius: 5px;
                padding: 15px;
                margin: 10px 0;
            '
            onclick='
                this.parentNode.removeChild(this);
            '
        >";
        $msg .= $message;
        $msg .= "</div>";
        echo $msg;
    }
    function Message($message = "Message") {
        $msg = "<div
            style='
                background-color: rgb(0,223,255);
                color: #000000;
                border-radius: 5px;
                padding: 15px;
                margin: 10px 0;
            '
            onclick='
                this.parentNode.removeChild(this);
            '
        >";
        $msg .= $message;
        $msg .= "</div>";
        echo $msg;
    }
}