
<div>Please Validate the following expersion:</div>
<div class="rand1"></div>
<div>+</div>
<div class="rand2"></div>
<a href="javascript:void(0);" onclick="randomnum();">Refresh</a>
<p id="capcha_message"></p>

<input type="text" id="total" autocomplete="off"  />

<style type="text/css">
    .rand1, .rand2
    {
        padding: 16px;
        background-color: #ADDB4B;
        margin: 25px 0;
        float: left;
        border-radius: 49px;
    }
    .plus
    {
        padding: 16px 0;
        margin: 25px 7px;
        float: left;
    }
    .re
    {
        padding:8px;
        background-color:#D8A217;
        margin:35px;
        float:left; cursor:pointer;
        box-shadow: 2px 2px 2px 1px #818181;
        -moz-box-shadow: 2px 2px 2px 1px #818181;
        -webkit-box-shadow: 2px 2px 2px 1px #818181;
        -ms-box-shadow: 2px 2px 2px 1px #818181;
        -o-box-shadow: 2px 2px 2px 1px #818181;
    }

    #total
    {
        margin:35px;
        height:30px;
        width:50px;
    }

</style>
<script>
    $(document).ready(function () {
        randomnum();
    });
    function randomnum()
    {
        var number1 = 5;
        var number2 = 50;
        var randomnum = (parseInt(number2) - parseInt(number1)) + 1;
        var rand1 = Math.floor(Math.random() * randomnum) + parseInt(number1);
        var rand2 = Math.floor(Math.random() * randomnum) + parseInt(number1);
        $(".rand1").html(rand1);
        $(".rand2").html(rand2);
    }
</script>
