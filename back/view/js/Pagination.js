class Pagination {

    constructor(total, crud, id, modal) {
        this.total = total;
        this.crud = crud;
        this.size = crud.sizePage;
        this.page = crud.numberPage;
        this.id = id;
        this.modal = modal;
        if (total % this.size == 0) {
            this.npage = parseInt(total / this.size);
        } else {
            this.npage = parseInt(total / this.size) + 1;
        }
        document.querySelector('#' + id).innerHTML = this.html();
        this.default();
        this.disabledLR()
        this.events();
    }

    html() {
        let pages = '';
        let disabled = '';
        this.npage == 0 ? disabled = 'disabled' : false;
        for (let it = 0; it < this.npage; it++) {
            pages += '<li class="page-item page-select" page="' + (it + 1) + '" id="' + this.id + '-page-' + (it + 1) + '"><a class="page-link">' + (it + 1) + '</a></li>'
        }
        let html = `
                    <li class="page-item disabled" id="` + this.id + `-page-back">
                        <a class="page-link"><span aria-hidden="true">&laquo;</span></a>
                    </li>` + pages + `
                    <li class="page-item ` + disabled + `" id="` + this.id + `-page-next">
                        <a class="page-link"><span aria-hidden="true">&raquo;</span> </a>
                    </li>
                `;
        return html;
    }

    default () {
        document.querySelector('#' + this.id + '-page-' + this.page).classList.add('active');
    }

    events() {
        let pageback = document.querySelector('#' + this.id + '-page-back');
        let pagenext = document.querySelector('#' + this.id + '-page-next');
        let clase = this;
        document.querySelectorAll('.page-select').forEach(item => {
            item.onclick = function () {
                clase.page = parseInt(item.getAttribute('page'));
                clase.crud.numberPage = clase.page;
                clase.disabledLR();
                cleanActive();
                clase.modal.show();
                this.classList.add('active');
            }
        });
        pageback.onclick = function () {
            if (!pageback.classList.contains('disabled')) {
                clase.page = clase.page - 1;
                clase.crud.numberPage = clase.page;
                cleanActive();
                clase.disabledLR();
                clase.modal.show();
                document.querySelector('#' + clase.id + '-page-' + clase.page).classList.add('active')
            }
        }
        pagenext.onclick = function () {
            if (!pagenext.classList.contains('disabled')) {
                clase.page = clase.page + 1;
                clase.crud.numberPage = clase.page;
                cleanActive();
                clase.disabledLR();
                clase.modal.show();
                document.querySelector('#' + clase.id + '-page-' + clase.page).classList.add('active')
            }
        }

        function cleanActive() {
            document.querySelectorAll('.page-select').forEach(item => {
                item.classList.remove('active');
            });
        }
    }

    disabledLR() {
        let pageback = document.querySelector('#' + this.id + '-page-back');
        let pagenext = document.querySelector('#' + this.id + '-page-next');
        if (this.page > 1) {
            pageback.classList.remove('disabled');
        } else {
            pageback.classList.add('disabled');
        }
        if (this.page == this.npage) {
            pagenext.classList.add('disabled');
        } else {
            pagenext.classList.remove('disabled');
        }
    }
}