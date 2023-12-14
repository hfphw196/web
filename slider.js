//      -----------              chuyển nền ------------------
const header = document.querySelector("header")
            window.addEventListener("scroll",function(){
                x = window.pageYOffset
                if(x>0){
                    header.classList.add("sticky")
                }
                else{
                    header.classList.remove("sticky")
                }
            })
    
    
            const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
            const imgContainer = document.querySelector('.aspect-ratio-169')
            let imgnumber = imgPosition.length
            let index = 0
            imgPosition.forEach(function(image, index){
                image.style.left = index*100 + "%"
            })
            function imgSlide (){
                index++;
                if(index >= imgnumber){
                    index = 0
                }
                imgContainer.style.left = "-" +index*100 + "%"
            }
            setInterval(imgSlide,5000)



//   -----------                     login  ----------------------
const wrapper = document.querySelector('.wrapper')
const loginLink = document.querySelector('.login-link')
const registerLink = document.querySelector('.register-link')
const btnLogin = document.querySelector('.btnLogin-popup')
const btnclose = document.querySelector('.icon-close')

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
})
loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
})

btnLogin.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
})
btnclose.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
})



