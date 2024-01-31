document.querySelector('[name = "type_val"]').addEventListener("change", function () {
    let selectedValue = this.value;
    let inputs = document.getElementsByTagName("input");
    for (let i = 0; i < inputs.length; i++) {
        let name = inputs[i].getAttribute("name");
        if (name && name.includes(selectedValue)) {
            inputs[i].parentNode.style.display = "block"
            inputs[i].style.display = "inline";
        } else {
            inputs[i].parentNode.style.display = "none"
            inputs[i].style.display = "none";
        }
    }
});