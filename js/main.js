$(document).ready(function() { $(".leaderboard-list").text($("#refresh .movie-container").length); });

$(".start-game").click(function(){start();});

window.onscroll = function() {scrollBtnShowHide()};
let btn = document.getElementById("scrollBtn");


function scrollBtnShowHide(){
    if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 && $(window).width() > 600)
    {
        btn.style.display = "block";
    }
    else {
        btn.style.display = "none";
    }
}

function scrollUp(){
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function changeList($number){
    let text = $number.text();
    document.cookie = 'cookie='+text;
    $("#refresh").load(location.href + " #refresh");
    $(".leaderboard-list").text(text);
}

function start(){
    var value = $("input[name='radiobtn']:checked").val();
    localStorage.setItem("rounds", value);
    location.replace("gamepage.php");
}