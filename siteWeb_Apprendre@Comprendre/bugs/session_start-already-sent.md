session_start(): Cannot send session cookie - headers already sent by (output started at line 1)

https://stackoverflow.com/questions/8812754/cannot-send-session-cache-limiter-headers-already-sent

"Headers already sent" means that your *PHP script already sent the HTTP headers*, and as such it can't make modifications to them now.

http://www.dessinemoiunsite.com/warning-cannot-modify-header-information-headers-already-sent-by/

https://apprendre-php.com/tutoriels/tutoriel-15-faire-une-redirection-vers-une-autre-page.html

https://stackoverflow.com/questions/6974691/php-page-redirect-problem-cannot-modify-header-information

I have much easier solution for you - it is simple! Just add this command at the very start of the php source:

ob_start();
This will start buffering the output, so that nothing is really output until the PHP script ends (or until you flush the buffer manually) - and also no headers are sent until that time! So you don't need to reorganize your code, just add this line at the very beginning of your code and that's it :-)