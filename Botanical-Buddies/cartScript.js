const discArr = ["10OFF", "15OFF", "20OFF", "25OFF", "50OFF"];



// window.onload = function() {
//     let y = document.getElementById('basket-subtotal').innerHTML.toFixed(2);
//     setCookie("price", y , 10); 

// };

// function findTotal() {
//     var arr = document.getElementsByName('total');
//     var tot = 0;

//     for (var i = 0; i < arr.length; i++) {
//     if (parseInt(arr[i].value))
//         tot += parseInt(arr[i].value);
//     }

//     document.getElementById('basket-subtotal').innerHTML = tot;
// }
// function remove() {
//     const element = document.getElementById("demo");
//     element.remove();
// }

function discount() {
    var input = document.getElementById("promo-code").value;
    var bool = 0;
    for (let i = 0; i < discArr.length; i++){
        if (input.toUpperCase() == discArr[i]){
            var x = document.getElementById('basket-subtotal').innerHTML;
            var percent = discArr[i].slice(0,2) / 100;
            var discount = x * percent;
            x = x - discount;
            alert(discArr[i].slice(0,2) + " percent off!");
            var taxPercent = 8.25 / 100;
            var tax = x * taxPercent;
            x = x + tax;
            document.getElementById('taxes').innerHTML = tax.toFixed(2);
            document.getElementById('basket-total').innerHTML = x.toFixed(2);
            document.getElementById('basket-promo').innerHTML = discount.toFixed(2);
            bool = 1;
            setCookie("price", x.toFixed(2), 10);
        }
    }
    if (bool == 0){
        alert("Invalid promo code.");
    }
    
}

// Function to create the cookie 
function setCookie(cName, cValue, expDays) {
    let date = new Date();
    date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
}

