
var incrementButton = document.getElementsByClassName('btn-inc');
var decrementButton = document.getElementsByClassName('btn-dec');


for (var i = 0; i < incrementButton.length; i++) {
    var button = incrementButton[i];
    button.addEventListener('click', function (event) {

        var buttonClicked = event.target;
        //console.log(buttonClicked);
        var input = buttonClicked.parentElement.children[1];
        //console.log(input);
        var inputValue = input.value;
        var newValue = parseInt(inputValue) + 1;

        input.value = newValue;

        if (newValue > 30) {
            input.value = 30;
            alertify.alert('Quý khách vui lòng chỉ được mua tối đa 30 sản phẩm!!').set('frameless', true); 
        } else {
            input.value = newValue;
        }


    })
}

for (var i = 0; i < decrementButton.length; i++) {
    var button = decrementButton[i];
    button.addEventListener('click', function (event) {
        var buttonClicked = event.target;
        var input = buttonClicked.parentElement.children[1];
        var inputValue = input.value;
        var newValue = parseInt(inputValue) - 1;

        if (newValue >= 1) {
            input.value = newValue;
        } else {
            input.value = 1;

        }



    })
}


$("input[name='quantity']").keyup(function () {

    var key = $(this).val();
    if (key > 30) {
        alertify.alert('Quý khách vui lòng chỉ được mua tối đa 30 sản phẩm!!').set('frameless', true); 
    }
})
