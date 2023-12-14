
//......................giohang...................../

//                            bật tắt show áo quần 
const itemsliderbar = document.querySelectorAll(".cartegory-left-li")
itemsliderbar.forEach(function(menu,index){
    menu.addEventListener("click",function(){
        menu.classList.toggle("block")
    })
})

// ...........................Product........./

//                         chuyển big img - small img ở product
const bigImg = document.querySelector(".product-content-left-big-img img")
const smallImg = document.querySelectorAll(".product-content-left-small-img img")
smallImg.forEach(function(imgItem,X){
    imgItem.addEventListener("click",function(){
        bigImg.src = imgItem.src
    })
})
//                       BẬT tắt thông tin ở product
const baoquan = document.querySelector(".baoquan")
const chitiet = document.querySelector(".chitiet")
const thamkhaosize = document.querySelector(".thamkhaosize")

if(baoquan){
    baoquan.addEventListener("click", function(){
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-thamkhaosize").style.display = "none"

    })
}
if(chitiet){
    chitiet.addEventListener("click", function(){
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-thamkhaosize").style.display = "none"


    })
}
if(thamkhaosize){
    thamkhaosize.addEventListener("click", function(){
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-thamkhaosize").style.display = "block"
    })
}
const button = document.querySelector(".product-content-right-bottom-top")
if(button){
    button.addEventListener("click", function(){
        document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeB")
    })
}
//  ................................    ..................................//
function performSearch() {
    var keyword = document.getElementById("searchInput").value;
    // Thực hiện xử lý tìm kiếm tại đây, có thể chuyển hướng đến trang search.php hoặc thực hiện các hành động khác dựa trên từ khoá tìm kiếm.
    console.log("Đã tìm kiếm với từ khóa: " + keyword);
}










