class Pagination {
    constructor(total, size, id) {
        this.total = total;
        this.size = size;
        if (total % size == 0) {
            this.npage = parseInt(total / size);
        } else {
            this.npage = parseInt(total / size) + 1;
        }
        this.page=1;
        this.id=id;
        document.querySelector('#'+id).innerHTML=this.html();
        this.default();
        this.events();
    }

    html(){
        let pages='';
        let disabled='';
        this.npage==0?disabled='disabled':false;
        for (let it = 0; it < this.npage; it++) {
            pages +='<li class="page-item page-select" id="'+this.id+'-page-'+(it+1)+'"><a class="page-link">'+(it+1)+'</a></li>'
        }
        let html =`
                    <li class="page-item disabled" id="`+this.id+`-page-back">
                        <a class="page-link"><span aria-hidden="true">&laquo;</span></a>
                    </li>
                    `
                    + pages +
                    `
                    <li class="page-item `+disabled+`" id="`+this.id+`-page-next">
                        <a class="page-link"><span aria-hidden="true">&raquo;</span> </a>
                    </li>
                `
        return html;
    }
    default(){
        document.querySelector('#'+this.id+'-page-'+1).classList.add('active');
    }
    events(){
        let pageback = document.querySelector('#'+this.id+'-page-back');
        let pagenext = document.querySelector('#'+this.id+'-page-next');
        let clase = this;
        document.querySelectorAll('.page-select').forEach(item => {
            item.onclick=function (e) {
                document.querySelectorAll('.page-item').forEach(item => {
                    item.classList.remove('active');
                });
                this.classList.add('active');
                if(parseInt(this.children[0].innerHTML)>1){
                    pageback.classList.remove('disabled');
                    pageback.addEventListener('click',back);
                }else{
                    pageback.classList.add('disabled');
                    pageback.removeEventListener('click',back);
                }
                if(parseInt(this.children[0].innerHTML)==clase.npage){
                    pagenext.classList.add('disabled');
                }else{
                    pagenext.classList.remove('disabled');
                }
            }
            function back(e) {
                alert();
            }
        });
        function next() {
            alert();
        }
    }

}

let test = new Pagination(40, 10, 'paginationEmployee');
console.info(test.npage);