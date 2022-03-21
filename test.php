<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      body, html {
        background: black;
      }
      canvas {
        width: 100%;
        height: 100%;
      }
      .resizable {
        background: white;
        width: 100px;
        height: 100px;
        position: absolute;
        top: 100px;
        left: 100px;
      }
      .resizable .resizers{
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        border: 3px solid #4286f4;
        box-sizing: border-box;
      }
      .resizable .resizers .resizer{
        width: 10px;
        height: 10px;
        border-radius: 50%; /*magic to turn square into circle*/
        background: white;
        border: 3px solid #4286f4;
        position: absolute;
      }
      .resizable .resizers .resizer.top-left {
        left: -8px;
        top: -8px;
        cursor: nwse-resize; /*resizer cursor*/
      }
      .resizable .resizers .resizer.top-right {
        right: -8px;
        top: -8px;
        cursor: nesw-resize;
      }
      .resizable .resizers .resizer.bottom-left {
        left: -8px;
        bottom: -8px;
        cursor: nesw-resize;
      }
      .resizable .resizers .resizer.bottom-right {
        right: -8px;
        bottom: -8px;
        cursor: nwse-resize;
      }
    </style>
  </head>
  <body>
    <img id="img" src="https://images.unsplash.com/photo-1604890574377-b1830f2e48e6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=701&q=80" alt="">


    <div class='resizable'>
      <canvas id="canvas"></canvas>
      <div class='resizers'>
        <div class='resizer top-left'></div>
        <div class='resizer top-right'></div>
        <div class='resizer bottom-left'></div>
        <div class='resizer bottom-right'></div>
      </div>
    </div>

    <script>
      window.onload = function() {
        var c = document.getElementById("canvas");
        var ctx = c.getContext("2d");
        var img = document.getElementById("img");
        ctx.drawImage(img, 10, 10);
      };


      /*Make resizable div by Hung Nguyen*/
      function makeResizableDiv(div) {
        const element = document.querySelector(div);
        const resizers = document.querySelectorAll(div + ' .resizer')
        const minimum_size = 20;
        let original_width = 0;
        let original_height = 0;
        let original_x = 0;
        let original_y = 0;
        let original_mouse_x = 0;
        let original_mouse_y = 0;
        for (let i = 0;i < resizers.length; i++) {
          const currentResizer = resizers[i];
          currentResizer.addEventListener('mousedown', function(e) {
            e.preventDefault()
            original_width = parseFloat(getComputedStyle(element, null).getPropertyValue('width').replace('px', ''));
            original_height = parseFloat(getComputedStyle(element, null).getPropertyValue('height').replace('px', ''));
            original_x = element.getBoundingClientRect().left;
            original_y = element.getBoundingClientRect().top;
            original_mouse_x = e.pageX;
            original_mouse_y = e.pageY;
            window.addEventListener('mousemove', resize)
            window.addEventListener('mouseup', stopResize)
          })

          function resize(e) {
            if (currentResizer.classList.contains('bottom-right')) {
              const width = original_width + (e.pageX - original_mouse_x);
              const height = original_height + (e.pageY - original_mouse_y)
              if (width > minimum_size) {
                element.style.width = width + 'px'
              }
              if (height > minimum_size) {
                element.style.height = height + 'px'
              }
            }
            else if (currentResizer.classList.contains('bottom-left')) {
              const height = original_height + (e.pageY - original_mouse_y)
              const width = original_width - (e.pageX - original_mouse_x)
              if (height > minimum_size) {
                element.style.height = height + 'px'
              }
              if (width > minimum_size) {
                element.style.width = width + 'px'
                element.style.left = original_x + (e.pageX - original_mouse_x) + 'px'
              }
            }
            else if (currentResizer.classList.contains('top-right')) {
              const width = original_width + (e.pageX - original_mouse_x)
              const height = original_height - (e.pageY - original_mouse_y)
              if (width > minimum_size) {
                element.style.width = width + 'px'
              }
              if (height > minimum_size) {
                element.style.height = height + 'px'
                element.style.top = original_y + (e.pageY - original_mouse_y) + 'px'
              }
            }
            else {
              const width = original_width - (e.pageX - original_mouse_x)
              const height = original_height - (e.pageY - original_mouse_y)
              if (width > minimum_size) {
                element.style.width = width + 'px'
                element.style.left = original_x + (e.pageX - original_mouse_x) + 'px'
              }
              if (height > minimum_size) {
                element.style.height = height + 'px'
                element.style.top = original_y + (e.pageY - original_mouse_y) + 'px'
              }
            }
          }

          function stopResize() {
            window.removeEventListener('mousemove', resize)
          }
        }
      }

      makeResizableDiv('.resizable')
    </script>
  </body>
</html>
