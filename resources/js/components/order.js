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
}
new Order();
