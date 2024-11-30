document.addEventListener('DOMContentLoaded', function(){
	const searchBtn = document.querySelector("#search");

    searchBtn.addEventListener('click', () => {
        const searchValue = document.querySelector(".search-box").value;
        getPosts(searchValue);
    });
});

function getPosts(searchValue){
    $.ajax({
        type: "POST",
        url: "get_posts.php",
        data: {"value": searchValue},
        cache: false,
        success: function(responce) {
            $('.output').html(responce);
            let text = document.querySelectorAll('.comment');
            text.forEach((item) => {
                item.innerHTML = item.innerHTML.replace(searchValue, "<font color=\"red\">"+ searchValue +"</font>");                
            })
        }
    })
    
    
}