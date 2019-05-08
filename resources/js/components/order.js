
class Order {
    constructor(order) {
        this.order = order;
        
        this.saveOrderButton = document.querySelectorAll('.order__served-button');
        this.saveOrderButton.forEach(button => {
            button.addEventListener('click', (event) => {
                this.update(button.getAttribute('order_id'), button.getAttribute('role'))
            });
        });
        
        this.orderNotReadyButton = document.querySelectorAll('.order__notReady');
        this.orderNotReadyButton.forEach(button => {
            button.addEventListener('click', (event) => {
                this.changeButton(button);
            });
        });
        this.getOrders();
    }
    
    update(order, role) {
        fetch('/order/ready', {
            method : 'post',
            credentials: "same-origin",
            mode: 'cors',
            headers: {
              'Content-Type': 'application/json',
              'Accept':       'application/json',
              'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
            },
            body: JSON.stringify({
                orderId: order,
                role: role,
            })
        })
          .then((res) => res.json())
          .then((data) => console.log(data))
          .catch((error) => console.log(error))
    }
    
    changeButton(button) {
        button.classList.remove('order__notReady');
        button.classList.add('order__ready');
    }
    
    getOrders() {
        setInterval(() => {
            let section = document.getElementsByClassName('section')[0]
            let orderContainer = document.getElementsByClassName('order__container');
            let table = document.getElementsByClassName('order__tableNr');
            let name = document.getElementsByClassName('user__name');
            let email = document.getElementsByClassName('user__email');
            fetch('/order/json')
                .then(function(response) {
                    return response.json();
                })
                .then(function(json) {
                    console.log(json)
                    if(json.length > orderContainer.length) {
                        let container = document.createElement("div");
                        container.classList = 'order__container';
                        let table = document.createElement("order__table");
                        table.classList = 'order__table';
                        var tableText = document.createTextNode("Tafel");
                        table.appendChild(tableText);
                        let tableNr = document.createElement('span');
                        tableNr.classList = 'order__tableNr';
                        tableNr.textContent = json[json.length - 1].table.table_nr;
                        table.appendChild(tableNr);
                        let orderField = document.createElement('div');
                        orderField.classList = 'order__field';
                        orderProducts = document.createElement('div');
                        orderProducts.classList = 'order__products';
                        console.log('products')
                        for(let i = 0; i < json[json.length - 1].products.length; i++) {
                            orderProduct = document.createElement('div');
                            orderProduct.classList = 'order__product';
                            orderProducts.appendChild(orderProduct)
                            productName = document.createElement('div');
                            productName.classList = 'order__product-name';
                            productName.textContent = json[json.length - 1].products[i].name;
                            productAmount = document.createElement('div');
                            productAmount.classList = 'order__product-amount';
                            productAmount.textContent = 1;
                            orderProduct.appendChild(productName);
                            orderProduct.appendChild(productAmount);
                        }
                        let orderServed = document.createElement('div');
                        orderServed.classList = 'order__served';
                        let orderServedText = document.createElement('h3');
                        orderServedText.textContent = 'Klaar om te serveren?';
                        let orderServedButton = document.createElement('button');
                        orderServedButton.classList = 'order__served-button order__notReady';
                        orderServedButton.setAttribute('order_id', json[json.length - 1].id);
                        orderServedButton.setAttribute('role', 'kok'); //fix this
                        orderServedButton.textContent = 'Klaar';

                        orderServed.appendChild(orderServedText);
                        orderServed.appendChild(orderServedButton);
                        orderField.appendChild(orderProducts)
                        orderField.appendChild(orderServed);
                        container.appendChild(table);
                        container.appendChild(orderField);
                        section.appendChild(container);
                    } 
                    else {
                        for(let i = 0; i < json.length; i++) {
                            table[i].textContent = json[i].table.table_nr;
                        }
                    }
                });
        }, 2000);
    }
}
new Order();
