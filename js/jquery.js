class CustomAlert {
    constructor(message, formId, success = true) {
        this.message = message;
        this.isSuccess = success;
        this.form = $(formId);

        this.create();
    }

    create() {
        let alert = this.form.children('.form-alert');
        let newAlert = `<div class="form-alert alert-${this.isSuccess ? 'success' : 'error'}">${this.message}</div>`;
        if (alert.length === 0) {
            this.form.prepend(newAlert);
            alert = $(newAlert);
        }
        else {
            alert = alert.replaceWith(newAlert);
        }

        console.log(alert);

        setTimeout(function () {
            alert.remove();
        }, 3000)
    }
}

function getAjaxData(ajax) {
    let data = ajax.data;
    data = data.split('&');

    let o = {};

    for (let i = 0; i < data.length; ++i) {
        let pair = data[i];
        let equalSign = pair.indexOf('=');
        let name = decodeURIComponent(pair.substring(0, equalSign));
        let value = decodeURIComponent(pair.substring(equalSign + 1));

        o[name] = value;
    }

    return o;
}