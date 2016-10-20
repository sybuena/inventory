<?php include(APPPATH.'/views/common/header.php'); ?>
<?php include(APPPATH.'/views/common/top_menu2.php'); ?>

 <style>
 .m-l-10 {margin-left: 10px}
    video {
        -moz-transition: all 1s ease;
        -ms-transition: all 1s ease;
        
        -o-transition: all 1s ease;
        -webkit-transition: all 1s ease;
        transition: all 1s ease;
        vertical-align: top;
        width: 100%;
    }

    input {
        border: 1px solid #d9d9d9;
        border-radius: 1px;
        font-size: 2em;
        margin: .2em;
        width: 30%;
    }

    select {
        border: 1px solid #d9d9d9;
        border-radius: 1px;
        height: 50px;
        margin-left: 1em;
        margin-right: -12px;
        padding: 1.1em;
        vertical-align: 6px;
        width: 18%;
    }

    .setup {
       /* border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        font-size: 102%;
        height: 47px;
        margin-left: -9px;
        margin-top: 8px;
        position: absolute;*/
    }

    p { padding: 1em; }

   /* li {
        border-bottom: 1px solid rgb(189, 189, 189);
        border-left: 1px solid rgb(189, 189, 189);
        padding: .5em;
    }*/
</style>
<!-- Content -->
<section id="main" data-layout="layout-1">
    

        <!-- <link rel="stylesheet" href="//cdn.webrtc-experiment.com/style.css"> -->
        
       
        <script>
            document.createElement('article');
            document.createElement('footer');
        </script>
        
        <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/ajhifddimkapgcifgcodmmfdlknahffk">
        
        <!-- scripts used for screen-sharing -->
        <!-- <script src='//cdn.webrtc-experiment.com/firebase.js'> </script> -->
        <script src='/assets/vendors/fireball.js'> </script>
        <script src='/assets/vendors/conference.js'> </script>
        <!-- <script src="//cdn.webrtc-experiment.com/Pluginfree-Screen-Sharing/conference.js"> </script> -->
        <div class="container">
            <div class="block-header">
                <h2>Screen Sharing</h2>
            </div>

            <div class="card m-b-0">
                <div class="card-header">
                    <h2>How to share your screen? <small>You can screenshare in public with this current link or make a private link for private screensharing</small></h2>
            
                </div>
                <div class="card-body card-padding">
                    <section id="content">
                   
                        <section class="experiment">                
                            <section>
                                <div>
                                    
                                    <span>Click text code on the right for private screenshare :
                                        <a href="/Pluginfree-Screen-Sharing/" target="_blank" title="Open this link for private screen sharing!">
                                            <code>
                                                <strong id="unique-token">#123456789</strong>
                                            </code>
                                        </a>
                                    </span>
                                    
                                </div>
                                <br>
                                
                                <div class="form-group fg-line">
                                    <label id="screen-type-title">Public Screen Sharing</label>
                                    <input type="text" class="form-control input-sm" id="room-name" placeholder="Your Name" disabled style="display:none">
                                </div>

                                
                                <button id="share-screen" disabled class="btn bgm-amber waves-effect">Share Your Screen</button>
                            </section>
                            
                            <!-- list of all available broadcasting rooms -->
                            <table style="width: 100%;" id="rooms-list"></table>
                            
                            <!-- local/remote videos container -->
                            <div id="videos-container"></div>
                        </section>
                
                        <section class="experiment">
                            <h2>Prerequisites</h2>
                            <ol>
                                <li>
                                    Chrome? 
                                    <a href="https://chrome.google.com/webstore/detail/screen-capturing/ajhifddimkapgcifgcodmmfdlknahffk" target="_blank">Store</a>
                                    / <a href="https://github.com/muaz-khan/Chrome-Extensions/tree/master/desktopCapture">Source Code</a>
                                    / 
                                    <button onclick="!!navigator.webkitGetUserMedia && !!window.chrome && !!chrome.webstore && !!chrome.webstore.install && chrome.webstore.install('https://chrome.google.com/webstore/detail/ajhifddimkapgcifgcodmmfdlknahffk', function() {location.reload();})" id="install-button" style="font-size:inherit; padding-bottom:0;">Click to Install</button>
                                </li>
                                
                                <li>
                                    Firefox? <a href="https://addons.mozilla.org/en-US/firefox/addon/enable-screen-capturing/">Store</a> / <a href="https://github.com/muaz-khan/Firefox-Extensions/tree/master/enable-screen-capturing">Source Code</a> / <button onclick="intallFirefoxScreenCapturingExtension(); this.disabled = true;" style="font-size:inherit; padding-bottom:0;">Click to Install</button>
                                </li>
                            </ol>
                        </section>
                        
                        <!-- <section class="experiment">
                            <h2 id="suggestions">
                                <a href="#suggestions">Suggestions</a>
                            </h2>
                            <blockquote class="inline">
                                <a href="https://chrome.google.com/webstore/detail/webrtc-desktop-sharing/nkemblooioekjnpfekmjhpgkackcajhg">There is a chrome-extension</a> for the same application; which allows you share any tab/screen any time without opening this page.
                            </blockquote>
                        </section>
                        
                        <section class="experiment">
                            <h2 id="advantages">
                                <a href="#advantages">Advantages</a>
                            </h2>
                            <ol>
                                <li>Share full screen with one or more users in <strong>HD</strong> format!</li>
                                <li>Share screen from chrome and view over all WebRTC compatible browsers/plugins.</li>
                                <li>
                                    You can open private rooms and it will be really "totally" private!<br /><br />
                                    <ol>
                                        <li>Use hashes to open private rooms: <strong>#private-room</strong></li>
                                        <li>Use URL parameters to open private rooms: <strong>?private=room</strong></li>
                                    </ol>
                                </li>
                            </ol>
                        </section>
                        
                        <section class="experiment">
                            <h2 id="common-queries">
                                <a href="#common-queries">Common issues & queries</a>
                            </h2>
                            <ol>
                                <li>Recursive cascade images or blurred screen experiences occur only when you try to share screen between two tabs on the same system. This NEVER happens when sharing between unique systems or devices.</li>
                                <li>Opera/IE/Safari has no support of screen-capturing yet. However, you can view shared screens on Opera/IE/Safari!</li>
                                <li>Remember, it is not desktop sharing! It is just a state-less screen sharing. Desktop sharing is possible only through native (C++) applications.</li>
                            </ol>
                        </section>
                    
                        <section class="experiment">
                            <h2 id="why-screen-fails">
                                <a href="#why-screen-fails">Why Screen Sharing Fails?</a>
                            </h2>
                            <ol>
                                <li>
                                    You've not used '<strong>chromeMediaSource</strong>' or '<strong>mediaSource</strong>' constraint: 
                                    <pre>
                            // for chrome
                            mandatory: {chromeMediaSource: 'screen'}
                            // or desktop-Capturing
                            mandatory: {chromeMediaSource: 'desktop'}

                            // for Firefox
                            video: {
                                mediaSource: 'window' || 'screen'
                            }
                                    </pre>
                                </li>
                                <li>On chrome, you requested audio-stream alongwith '<strong>chromeMediaSource</strong>' – it is not permitted on chrome. Remember, Firefox is supporting audio+screen from single getUserMedia request.</li>
                                <li>On chrome, you're not testing it on SSL origin (HTTPS domain) otherwise you didn't enable <code><a href="http://peter.sh/experiments/chromium-command-line-switches/#allow-http-screen-capture" target="_blank">--allow-http-screen-capture</a></code> command-line flag on canary. Firefox is supporting screen capturing from both HTTP and HTTPs domains.</li>
                                <li>You may used media constraints like min/max frameRate; bandwidth or min/max width/height like 2000*2000 that is "currently" not allowed.</li>
                            </ol>
                            
                            <p>
                                <strong><code>mandatory: {chromeMediaSource: 'tab'}</code></strong> is useful only in chrome extensions. See <a href="https://www.webrtc-experiment.com/screen-broadcast/">Tab sharing using tabCapture APIs</a>.
                            </p>
                        </section> -->
                        
                        
                    </section>
                </div>
            </div>
        </div>
 </section>

<?php include(APPPATH.'/views/common/footer.php'); ?>
  <script>
    function intallFirefoxScreenCapturingExtension() {
        InstallTrigger.install({
            'Foo': {
                // URL: 'https://addons.mozilla.org/en-US/firefox/addon/enable-screen-capturing/',
                URL: 'https://addons.mozilla.org/firefox/downloads/file/355418/enable_screen_capturing_in_firefox-1.0.006-fx.xpi?src=cb-dl-hotness',
                toString: function() {
                    return this.URL;
                }
            }
        });
    }

    // Muaz Khan     - https://github.com/muaz-khan
    // MIT License   - https://www.webrtc-experiment.com/licence/
    // Documentation - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/Pluginfree-Screen-Sharing
    
    var isWebRTCExperimentsDomain = document.domain.indexOf('webrtc-experiment.com') != -1;

    var config = {
        openSocket: function(config) {
            var channel = config.channel || 'screen-capturing-' + location.href.replace( /\/|:|#|%|\.|\[|\]/g , '');
            var socket = new Firebase('https://webrtc.firebaseIO.com/' + channel);
            socket.channel = channel;
            socket.on("child_added", function(data) {
                config.onmessage && config.onmessage(data.val());
            });
            socket.send = function(data) {
                this.push(data);
            };
            config.onopen && setTimeout(config.onopen, 1);
            socket.onDisconnect().remove();
            return socket;
        },
        onRemoteStream: function(media) {
            var video = media.video;
            video.setAttribute('controls', true);
            videosContainer.insertBefore(video, videosContainer.firstChild);
            video.play();
            rotateVideo(video);
        },
        onRoomFound: function(room) {
            if(location.hash.replace('#', '').length) {
                // private rooms should auto be joined.
                conferenceUI.joinRoom({
                    roomToken: room.roomToken,
                    joinUser: room.broadcaster
                });
                return;
            }
            
            var alreadyExist = document.getElementById(room.broadcaster);
            if (alreadyExist) return;

            if (typeof roomsList === 'undefined') roomsList = document.body;

            var tr = document.createElement('tr');
            tr.setAttribute('id', room.broadcaster);
            tr.innerHTML = '<td>' + room.roomName + '</td>' +
                '<td><button class="join" id="' + room.roomToken + '">Open Screen</button></td>';
            roomsList.insertBefore(tr, roomsList.firstChild);

            var button = tr.querySelector('.join');
            button.onclick = function() {
                var button = this;
                button.disabled = true;
                conferenceUI.joinRoom({
                    roomToken: button.id,
                    joinUser: button.parentNode.parentNode.id
                });
            };
        },
        onNewParticipant: function(numberOfParticipants) {
            document.title = numberOfParticipants + ' users are viewing your screen!';
            var element = document.getElementById('number-of-participants');
            if (element) {
                element.innerHTML = numberOfParticipants + ' users are viewing your screen!';
            }
        },
        oniceconnectionstatechange: function(state) {
            if(state == 'failed') {
                alert('Failed to bypass Firewall rules. It seems that target user did not receive your screen. Please ask him reload the page and try again.');
            }
            
            if(state == 'connected') {
                alert('A user successfully received your screen.');
            }
        }
    };

    function captureUserMedia(callback, extensionAvailable) {
        console.log('captureUserMedia chromeMediaSource', DetectRTC.screen.chromeMediaSource);
        
        var screen_constraints = {
            mandatory: {
                chromeMediaSource: DetectRTC.screen.chromeMediaSource,
                maxWidth: screen.width > 1920 ? screen.width : 1920,
                maxHeight: screen.height > 1080 ? screen.height : 1080
                // minAspectRatio: 1.77
            },
            optional: [{ // non-official Google-only optional constraints
                googTemporalLayeredScreencast: true
            }, {
                googLeakyBucket: true
            }]
        };

        // try to check if extension is installed.
        if(isChrome && isWebRTCExperimentsDomain && typeof extensionAvailable == 'undefined' && DetectRTC.screen.chromeMediaSource != 'desktop') {
            DetectRTC.screen.isChromeExtensionAvailable(function(available) {
                captureUserMedia(callback, available);
            });
            return;
        }
        
        if(isChrome && isWebRTCExperimentsDomain && DetectRTC.screen.chromeMediaSource == 'desktop' && !DetectRTC.screen.sourceId) {
            DetectRTC.screen.getSourceId(function(error) {
                if(error && error == 'PermissionDeniedError') {
                    alert('PermissionDeniedError: User denied to share content of his screen.');
                }
                
                captureUserMedia(callback);
            });
            return;
        }
        
        // for non-www.webrtc-experiment.com domains
        if(isChrome && !isWebRTCExperimentsDomain && !DetectRTC.screen.sourceId) {
            window.addEventListener('message', function (event) {
                if (event.data && event.data.chromeMediaSourceId) {
                    var sourceId = event.data.chromeMediaSourceId;

                    DetectRTC.screen.sourceId = sourceId;
                    DetectRTC.screen.chromeMediaSource = 'desktop';

                    if (sourceId == 'PermissionDeniedError') {
                        return alert('User denied to share content of his screen.');
                    }

                    captureUserMedia(callback, true);
                }

                if (event.data && event.data.chromeExtensionStatus) {
                    warn('Screen capturing extension status is:', event.data.chromeExtensionStatus);
                    DetectRTC.screen.chromeMediaSource = 'screen';
                    captureUserMedia(callback, true);
                }
            });
            screenFrame.postMessage();
            return;
        }
        
        if(isChrome && DetectRTC.screen.chromeMediaSource == 'desktop') {
            screen_constraints.mandatory.chromeMediaSourceId = DetectRTC.screen.sourceId;
        }
        
        var constraints = {
            audio: false,
            video: screen_constraints
        };
        
        if(!!navigator.mozGetUserMedia) {
            console.warn(Firefox_Screen_Capturing_Warning);
            constraints.video = {
                mozMediaSource: 'window',
                mediaSource: 'window',
                maxWidth: 1920,
                maxHeight: 1080,
                minAspectRatio: 1.77
            };
        }
        
        console.log( JSON.stringify( constraints , null, '\t') );
        
        var video = document.createElement('video');
        video.setAttribute('autoplay', true);
        video.setAttribute('controls', true);
        videosContainer.insertBefore(video, videosContainer.firstChild);
        
        getUserMedia({
            video: video,
            constraints: constraints,
            onsuccess: function(stream) {
                config.attachStream = stream;
                callback && callback();

                video.setAttribute('muted', true);
                rotateVideo(video);
            },
            onerror: function() {
                if (isChrome && location.protocol === 'http:') {
                    alert('Please test this WebRTC experiment on HTTPS.');
                } else if(isChrome) {
                    alert('Screen capturing is either denied or not supported. Please install chrome extension for screen capturing or run chrome with command-line flag: --enable-usermedia-screen-capturing');
                }
                else if(!!navigator.mozGetUserMedia) {
                    alert(Firefox_Screen_Capturing_Warning);
                }
            }
        });
    }

    /* on page load: get public rooms */
    var conferenceUI = conference(config);

    /* UI specific */
    var videosContainer = document.getElementById("videos-container") || document.body;
    var roomsList = document.getElementById('rooms-list');

    document.getElementById('share-screen').onclick = function() {
        var roomName = document.getElementById('room-name') || { };
        roomName.disabled = true;
        captureUserMedia(function() {
            conferenceUI.createRoom({
                roomName: (roomName.value || 'Anonymous') + ' shared his screen with you'
            });
        });
        this.disabled = true;
    };

    function rotateVideo(video) {
        video.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
        setTimeout(function() {
            video.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
        }, 1000);
    }

    /** -----------------------------------------------------------
            CHECKER FOR PUBLIC OR PRIVATE SCREEN SHARE
        ----------------------------------------------------------- */
    (function() {
        var uniqueToken = document.getElementById('unique-token');
        if (uniqueToken)
            if (location.hash.length > 2) {
                uniqueToken.parentNode.parentNode.parentNode.innerHTML = '<h2 style="text-align:center;"><a href="' + location.href + '" target="_blank">Share this link</a></h2>';
                $('#screen-type-title').html('Private Screen Sharing');
            } else {
                uniqueToken.innerHTML = uniqueToken.parentNode.parentNode.href = '#' + (Math.random() * new Date().getTime()).toString(36).toUpperCase().replace( /\./g , '-');
                $('#screen-type-title').html('Public Screen Sharing');
            }
    })();
    
    var Firefox_Screen_Capturing_Warning = 'Make sure that you are using Firefox Nightly and you enabled: media.getusermedia.screensharing.enabled flag from about:config page. You also need to add your domain in "media.getusermedia.screensharing.allowed_domains" flag.';

</script>

<script>
    var screenFrame, loadedScreenFrame;
    
    function loadScreenFrame(skip) {
        if(loadedScreenFrame) return;
        if(!skip) return loadScreenFrame(true);

        loadedScreenFrame = true;

        var iframe = document.createElement('iframe');
        iframe.onload = function () {
            iframe.isLoaded = true;
            console.log('Screen Capturing frame is loaded.');
            
            document.getElementById('share-screen').disabled = false;
            document.getElementById('room-name').disabled = false;
        };
        iframe.src = 'https://www.webrtc-experiment.com/getSourceId/';
        iframe.style.display = 'none';
        (document.body || document.documentElement).appendChild(iframe);

        screenFrame = {
            postMessage: function () {
                if (!iframe.isLoaded) {
                    setTimeout(screenFrame.postMessage, 100);
                    return;
                }
                console.log('Asking iframe for sourceId.');
                iframe.contentWindow.postMessage({
                    captureSourceId: true
                }, '*');
            }
        };
    };
    
    if(!isWebRTCExperimentsDomain) {
        loadScreenFrame();
    }
    else {
        document.getElementById('share-screen').disabled = false;
        document.getElementById('room-name').disabled = false;
    }
</script>

<script>
    // todo: need to check exact chrome browser because opera also uses chromium framework
    var isChrome = !!navigator.webkitGetUserMedia;
    
    // DetectRTC.js - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/DetectRTC
    // Below code is taken from RTCMultiConnection-v1.8.js (http://www.rtcmulticonnection.org/changes-log/#v1.8)
    var DetectRTC = {};

    (function () {
        
        var screenCallback;
        
        DetectRTC.screen = {
            chromeMediaSource: 'screen',
            getSourceId: function(callback) {
                if(!callback) throw '"callback" parameter is mandatory.';
                screenCallback = callback;
                window.postMessage('get-sourceId', '*');
            },
            isChromeExtensionAvailable: function(callback) {
                if(!callback) return;
                
                if(DetectRTC.screen.chromeMediaSource == 'desktop') return callback(true);
                
                // ask extension if it is available
                window.postMessage('are-you-there', '*');
                
                setTimeout(function() {
                    if(DetectRTC.screen.chromeMediaSource == 'screen') {
                        callback(false);
                    }
                    else callback(true);
                }, 2000);
            },
            onMessageCallback: function(data) {
                if (!(typeof data == 'string' || !!data.sourceId)) return;
                
                console.log('chrome message', data);
                
                // "cancel" button is clicked
                if(data == 'PermissionDeniedError') {
                    DetectRTC.screen.chromeMediaSource = 'PermissionDeniedError';
                    if(screenCallback) return screenCallback('PermissionDeniedError');
                    else throw new Error('PermissionDeniedError');
                }
                
                // extension notified his presence
                if(data == 'rtcmulticonnection-extension-loaded') {
                    if(document.getElementById('install-button')) {
                        document.getElementById('install-button').parentNode.innerHTML = '<strong>Great!</strong> <a href="https://chrome.google.com/webstore/detail/screen-capturing/ajhifddimkapgcifgcodmmfdlknahffk" target="_blank">Google chrome extension</a> is installed.';
                    }
                    DetectRTC.screen.chromeMediaSource = 'desktop';
                }
                
                // extension shared temp sourceId
                if(data.sourceId) {
                    DetectRTC.screen.sourceId = data.sourceId;
                    if(screenCallback) screenCallback( DetectRTC.screen.sourceId );
                }
            },
            getChromeExtensionStatus: function (callback) {
                if (!!navigator.mozGetUserMedia) return callback('not-chrome');
                
                var extensionid = 'ajhifddimkapgcifgcodmmfdlknahffk';

                var image = document.createElement('img');
                image.src = 'chrome-extension://' + extensionid + '/icon.png';
                image.onload = function () {
                    DetectRTC.screen.chromeMediaSource = 'screen';
                    window.postMessage('are-you-there', '*');
                    setTimeout(function () {
                        if (!DetectRTC.screen.notInstalled) {
                            callback('installed-enabled');
                        }
                    }, 2000);
                };
                image.onerror = function () {
                    DetectRTC.screen.notInstalled = true;
                    callback('not-installed');
                };
            }
        };
        
        // check if desktop-capture extension installed.
        if(window.postMessage && isChrome) {
            DetectRTC.screen.isChromeExtensionAvailable();
        }
    })();
    
    DetectRTC.screen.getChromeExtensionStatus(function(status) {
        if(status == 'installed-enabled') {
            if(document.getElementById('install-button')) {
                document.getElementById('install-button').parentNode.innerHTML = '<strong>Great!</strong> <a href="https://chrome.google.com/webstore/detail/screen-capturing/ajhifddimkapgcifgcodmmfdlknahffk" target="_blank">Google chrome extension</a> is installed.';
            }
            DetectRTC.screen.chromeMediaSource = 'desktop';
        }
    });
    
    window.addEventListener('message', function (event) {
        if (event.origin != window.location.origin) {
            return;
        }
        
        DetectRTC.screen.onMessageCallback(event.data);
    });
    
    console.log('current chromeMediaSource', DetectRTC.screen.chromeMediaSource);
</script>
