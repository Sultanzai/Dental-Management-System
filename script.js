document.querySelector(".jsFilter").addEventListener("click", function () {
  document.querySelector(".filter-menu").classList.toggle("active");
});

document.querySelector(".grid").addEventListener("click", function () {
  document.querySelector(".list").classList.remove("active");
  document.querySelector(".grid").classList.add("active");
  document.querySelector(".products-area-wrapper").classList.add("gridView");
  document
    .querySelector(".products-area-wrapper")
    .classList.remove("tableView");
});

document.querySelector(".list").addEventListener("click", function () {
  document.querySelector(".list").classList.add("active");
  document.querySelector(".grid").classList.remove("active");
  document.querySelector(".products-area-wrapper").classList.remove("gridView");
  document.querySelector(".products-area-wrapper").classList.add("tableView");
});

var modeSwitch = document.querySelector('.mode-switch');
modeSwitch.addEventListener('click', function () {                      document.documentElement.classList.toggle('light');
 modeSwitch.classList.toggle('active');
});


var current = null;
document.querySelector('#email').addEventListener('focus', function(e) {
  if (current) current.pause();
  current = anime({
    targets: 'path',
    strokeDashoffset: {
      value: 0,
      duration: 700,
      easing: 'easeOutQuart'
    },
    strokeDasharray: {
      value: '240 1386',
      duration: 700,
      easing: 'easeOutQuart'
    }
  });
});
document.querySelector('#password').addEventListener('focus', function(e) {
  if (current) current.pause();
  current = anime({
    targets: 'path',
    strokeDashoffset: {
      value: -336,
      duration: 700,
      easing: 'easeOutQuart'
    },
    strokeDasharray: {
      value: '240 1386',
      duration: 700,
      easing: 'easeOutQuart'
    }
  });
});
document.querySelector('#submit').addEventListener('focus', function(e) {
  if (current) current.pause();
  current = anime({
    targets: 'path',
    strokeDashoffset: {
      value: -730,
      duration: 700,
      easing: 'easeOutQuart'
    },
    strokeDasharray: {
      value: '530 1386',
      duration: 700,
      easing: 'easeOutQuart'
    }
  });
});



let form = document.querySelector(".form-content");
let content =document.querySelector(".content");


// Click on the blank area of the interface and some small bubbles will rise
content.addEventListener("click",bubble,false)

function randomColor(){
           let r = Math.round(Math.random()*90+165)
           let g = Math.round(Math.random()*90+165)
           let b = Math.round(Math.random()*90+165)
           let a = Math.random()
           const color = `rgba(${r},${g},${b},${a})`
           // console.log(color)
           return color
       }

       function bubble(){
           let formBox = form.getBoundingClientRect()
           let x = event.clientX;
           let y = event.clientY;     if(x>formBox.left&&x<formBox.right&&y>formBox.top&&y<formBox.bottom){
               return false
           }
           let ball = [];
           let div =document.createElement('div');
           for(let i =0;i<3;i++){
               ball[i]= document.createElement('div');
               ball[i].className='bubble'
               ball[i].style.backgroundColor = randomColor();
               ball[i].style.top = y-Math.round(Math.random()*20)+'px';
               ball[i].style.left = x+Math.round(Math.random()*20)+'px';
               div.appendChild(ball[i])
           }
           content.appendChild(div)
           setTimeout(()=>{
               ball.forEach((item)=>{
               item.style.top = y-Math.round(Math.random()*60+20)+'px';
               item.style.left = x+Math.round(Math.random()*40-20)+'px';
               })
           },200)
           setTimeout(()=>{
               ball.forEach((item)=>{
               item.style.backgroundColor = "transparent";
               })
           },700)
           setTimeout(()=>{
               content.removeChild(div)
           },1200)
       }
   