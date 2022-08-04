<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- Payment button -->
<button class="stripe-button" style="display:none" id="checkoutBtn">
   pay
</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>

    // Set Stripe publishable key to initialize Stripe.js
    const stripe = Stripe('pk_test_51L1CSDB0DWwA7fx5BZRf6IfBsT3DJNqPshIxaomud8Jm3TiQSm5rguqylGxEPrWey5VCnUrpuCdHDyYIyQpDgs1y00Ua3gmIhW');

    // Select payment button
    const payBtn = document.querySelector("#checkoutBtn");

    // Payment request handler
    payBtn.addEventListener("click", function (evt) {

        setLoading(true);

        createCheckoutSession().then(function (data) {
            if(data.sessionId){
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            }else{
                handleResult(data);
            }
        });
    });

    // Create a Checkout Session with the selected product
    const createCheckoutSession = function (stripe) {
        const data ="{{$teamid}}";

        return fetch("https://demosite.usapickleballnetwork.com/playerone-checkout", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            body: JSON.stringify({
                createCheckoutSession: 1,
                data:data
            }),
        }).then(function (result) {
            return result.json();
        });
    };

    // Handle any errors returned from Checkout
    const handleResult = function (result) {
        if (result.error) {
            showMessage(result.error.message);
        }

        setLoading(false);
    };

    // Show a spinner on payment processing
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            payBtn.disabled = true;
            // document.querySelector("#spinner").classList.remove("hidden");
            // document.querySelector("#buttonText").classList.add("hidden");
        } else {
            // Enable the button and hide spinner
            payBtn.disabled = false;
            // document.querySelector("#spinner").classList.add("hidden");
            //  document.querySelector("#buttonText").classList.remove("hidden");
        }
    }

    // Display message
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#paymentResponse");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 5000);
    }
    
    window.onload=function(){
$("#checkoutBtn").click();
}
</script>
