<style>
    .hide-popup{
        display: none;
    }
    .show-popup{
        display: block;
    }
    .hidden {
        display: none;
    }
    .visuallyhidden {
        opacity: 0;
    }
    .visually-transform{
        transform: scale(0);
    }
    #pop-up-content{
        box-shadow: 0 0 4px 0 rgb(0 0 0 / 20%);
        border-radius: 5px;
        transition: all .3s;
        padding: 18px 27px;
        display: block;
        background: #fff;
        max-width: 600px;
        position: relative;
        top: 38%;
        margin: auto;
    }
    .overlay-popup{
        position: fixed; 
        /* display: none; */
        width: 100%; 
        height: 100%; 
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 2; 
        transition: all .3s;
    }

    .close-pop-up{
        position: absolute;
        right: 18px;
        color: gray;
        cursor: pointer;
    }
</style>
<div class="overlay-popup hidden visuallyhidden" id="overlayPopup">
    <div id="pop-up-content" class=" hidden visually-transform">
        <i class="fas fa-times close-pop-up" id="closePopup"></i>
    
        {{ $slot }}
    
    </div>
</div>
<script>
    document.getElementById("closePopup").addEventListener("click", function() {
        let popup =  document.getElementById("pop-up-content")
        let overlay =  document.getElementById("overlayPopup")
            popup.classList.add('visually-transform');  
            overlay.classList.add('visuallyhidden');  
            popup.addEventListener('transitionend', function(e) {
                popup.classList.add('hidden');
                overlay.classList.add('hidden');
            }, {
                capture: false,
                once: true,
                passive: false
            });

            
    })
    document.getElementById("overlayPopup").addEventListener("click", function(){
        window.onclick = function (event) {
            let popup =  document.getElementById("pop-up-content")
            let overlay =  document.getElementById("overlayPopup")
            if(event.target == overlay){
                popup.classList.add('visually-transform');  
                overlay.classList.add('visuallyhidden');  
                popup.addEventListener('transitionend', function(e) {
                    popup.classList.add('hidden');
                    overlay.classList.add('hidden');
                }, {
                    capture: false,
                    once: true,
                    passive: false
                });

            }
        }
        
    })
    document.getElementById("open-popup").addEventListener("click", function() {
        // document.getElementById("pop-up-content").classList.add("show-popup")
        let popup =  document.getElementById("pop-up-content")
        let overlay =  document.getElementById("overlayPopup")
        if (popup.classList.contains('hidden')) {
            popup.classList.remove('hidden');
            overlay.classList.remove('hidden');
            setTimeout(function () {
                popup.classList.remove('visually-transform');
                overlay.classList.remove('visuallyhidden');
            }, 20);
        } else {
            popup.classList.add('visually-transform');  
            overlay.classList.add('visuallyhidden');  
            popup.addEventListener('transitionend', function(e) {
                popup.classList.add('hidden');
                overlay.classList.add('hidden');
            }, {
                capture: false,
                once: true,
                passive: false
            });
        }
    });
</script>