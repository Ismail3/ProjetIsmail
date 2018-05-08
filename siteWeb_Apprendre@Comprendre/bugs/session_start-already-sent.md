session_start(): Cannot send session cookie - headers already sent by (output started at line 1)

https://stackoverflow.com/questions/8812754/cannot-send-session-cache-limiter-headers-already-sent

"Headers already sent" means that your *PHP script already sent the HTTP headers*, and as such it can't make modifications to them now.