<head>
    <title>Shop</title>
    <script>
        ! function(e, o, t) {
            e[t] = function(n, r) {
                var c = {
                        sandbox: "https://sandbox-merchant.revolut.com/embed.js",
                        prod: "https://merchant.revolut.com/embed.js",
                        dev: "https://merchant.revolut.codes/embed.js"
                    },
                    d = o.createElement("script");
                d.id = "revolut-checkout", d.src = c[r] || c.prod, d.async = !0, o.head.appendChild(d);
                var s = {
                    then: function(r, c) {
                        d.onload = function() {
                            r(e[t](n))
                        }, d.onerror = function() {
                            o.head.removeChild(d), c && c(new Error(t + " is failed to load"))
                        }
                    }
                };
                return "function" == typeof Promise ? Promise.resolve(s) : s
            }
        }(window, document, "RevolutCheckout");
    </script>
</head>

<form id="form">
    <div id="card-input"></div>
    <button>Submit</button>
</form>

<script>
    RevolutCheckout('TYGpgANzNNcekurtImIhfTWI_0CrHqXD2o9dMCxfB3Jbd5UJZ5R-6SYsdqP_LdKI', "sandbox").then(function(RC) {
        var form = document.getElementById('form')
        var cardInput = document.getElementById('card-input');

        var card = RC.createCardField({
            // empty `<div>` inside your form
            target: cardInput,
            // callback called when payment finished successfully
            onSuccess() {
                window.alert('Thank you!')
            },
            // callback in case error happened
            onError(message) {
                window.alert('Oh no :(')
            },
            // callback in validation status change
            onValidation(messages) {
                console.log(messages) // -> [ 'Your card has expired' ]
            },
            // (optional) Callback in case user cancelled a transaction
            onCancel() {
                window.alert("Payment cancelled!")
            },
            // (optional) see API reference
            styles: {},
            // (optional) see API reference
            classes: {},
        })

        form.addEventListener('submit', function(event) {
            event.preventDefault()

            /**
              Gather additional info from the form if needed
              and submit card number to finish the order
            */

            card.submit({
                // (optional) name of the customer
                name: 'First Last',
                // (optional) email of the customer
                email: 'customer@example.com',
                // (optional) phone of the customer
                phone: '+447950630319',
                // (optional) billing address of the customer
                billingAddress: {
                    countryCode: 'UK',
                    region: 'Greater London',
                    city: 'London',
                    streetLine1: 'Revolut',
                    streetLine2: '1 Canada Square',
                    postcode: 'EC2V 6DN',
                },
                // (optional) shipping address of the customer
                shippingAddress: {
                    countryCode: 'UK',
                    region: 'Greater London',
                    city: 'London',
                    streetLine1: 'Revolut',
                    streetLine2: '1 Canada Square',
                    postcode: 'EC2V 6DN',
                },
            })
        })
    });
</script>