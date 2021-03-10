<template>
    <div>
        <b-container>
            <b-collapse id="my-collapse">
                <b-row id="display">
                    <b-col md="12">
                        <b-card>
                            <b-form @submit.prevent="addProducts">
                                <b-row>
                                    <b-col md="6">
                                        <b-form-group
                                            id="category_id"
                                            label="Category Name"
                                            label-for="category_id">
                                            <b-form-select v-model="form.category_id" :options="categories.name"></b-form-select>
<!--                                            <b-form-input-->
<!--                                                id="category_id"-->
<!--                                                v-model="form.category_id"-->
<!--                                                :class="{'is-invalid': form.errors.has('category_id')}"-->
<!--                                                type="text"-->
<!--                                                placeholder="Enter your category"-->
<!--                                            ></b-form-input>-->
                                        </b-form-group>
                                    </b-col>
                                    <b-col md="6">
                                        <b-form-group
                                            id="p_name"
                                            label="Product Name"
                                            label-for="p_name">
                                            <b-form-input
                                                id="p_name"
                                                v-model="form.p_name"
                                                :class="{'is-invalid': form.errors.has('p_name')}"
                                                type="text"
                                                placeholder="Enter your Product Name"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>
                                    <b-col md="6">
                                        <b-form-group id="p_price" label="Product Price" label-for="p_price">
                                            <b-form-input
                                                id="p_price"
                                                type="tel"
                                                v-model="form.p_price"
                                                maxlength="11" pattern="[0-9]{11}"
                                                :class="{'is-invalid': form.errors.has('p_price')}"
                                                placeholder="Enter your phone..."
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>
                                    <b-col md="6">
                                        <b-form-group id="p_brand" label="Product Brand" label-for="p_brand">
                                            <b-form-input
                                                id="p_brand"
                                                type="text"
                                                v-model="form.p_brand"
                                                :class="{'is-invalid': form.errors.has('p_brand')}"
                                                placeholder="Enter your Product Brand"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>
                                    <b-col md="6">
                                        <b-form-group id="p_quantity" label="Product Quantity" label-for="p_quantity">
                                            <b-form-input
                                                id="p_quantity"
                                                type="text"
                                                v-model="form.p_quantity"
                                                :class="{'is-invalid': form.errors.has('p_quantity')}"
                                                placeholder="Enter your Product Brand"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>
                                    <b-col md="6">
                                        <b-form-group
                                            id="p_barcode"
                                            label="Product Barcode"
                                            label-for="p_barcode">
                                            <b-form-input
                                                id="p_barcode"
                                                v-model="form.p_barcode"
                                                :class="{'is-invalid': form.errors.has('p_barcode')}"
                                                type="text"
                                                placeholder="Product Bar-Code"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>
                                    <b-col md="6">
                                        <b-form-group
                                            id="p_status"
                                            label="Product Status"
                                            label-for="p_status">
                                            <b-form-input
                                                id="p_status"
                                                v-model="form.p_status"
                                                :class="{'is-invalid': form.errors.has('p_status')}"
                                                type="text"
                                                placeholder="Enter Coupon Code"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>
                                </b-row>

                                <b-row>
                                    <b-col md="12" class="d-flex justify-content-end">
                                        <b-button-group>
                                            <b-button v-b-tooltip.hover.top="'Save'" type="submit" size="sm" variant="outline-primary"><b-icon icon="file-earmark-post-fill" scale="1" shift-v="1.25" aria-hidden="true"></b-icon>
                                            </b-button>
                                            <b-button v-b-tooltip.hover.bottom="'Reset'" type="reset" size="sm"><b-icon icon="arrow-clockwise" animation="spin" font-scale="1"></b-icon>
                                            </b-button>
                                            <b-button v-b-tooltip.hover.bottom="'Cancel'" type="button" size="sm" variant="danger" v-b-toggle.my-collapse><b-icon icon="x-diamond" scale="1" shift-v="1.25" aria-hidden="true"></b-icon>
                                            </b-button>
                                        </b-button-group>
                                    </b-col>
                                </b-row>
                            </b-form>
                        </b-card>
                    </b-col>
                </b-row>
            </b-collapse>


            <b-card>
                <b-row>
                    <b-col striped :sm="pageSize" :md="pageSize" class="my-1">
                        <b-form-group
                            label="Per page"
                            label-cols-sm="6"
                            label-cols-md="6"
                            label-cols-lg="6"
                            label-align-sm="left"
                            label-size="sm"
                            label-for="perPageSelect"
                            class="mb-0">
                            <b-form-select v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions"></b-form-select>
                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-button v-b-toggle.my-collapse class="btn btn-info font-weight-bolder float-right btn-sm" :variant="btnVariant" id="add" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);">{{ btnTxt }}</b-button>
                    </b-col>
                    <b-col :sm="searchSize" :md="searchSize" class="my-1 ml-auto">
                        <b-input-group size="sm">
                            <b-form-input
                                v-model="rawInput"
                                type="search"
                                label-align-sm="right"
                                id="filterInput"
                                placeholder="Type to Search"
                                :debounce="200"></b-form-input>
                            <b-input-group-append>
                                <b-button class="data-table-filter" :disabled="!filter" @click="clear()">Clear</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <b-table striped hover
                                 :filter="filter"
                                 :fields="fields"
                                 :items="products"
                                 :per-page="perPage"
                                 responsive
                                 class="text-nowrap"
                                 :current-page="currentPage"
                                 :filter-ignored-fields="filterIgnoredFields"
                                 :filter-included-fields="filterIncludedFields"
                                 @filtered="onFiltered">
                            <template v-slot:cell(index)="row" v-if="currentPage <= 1">
                                {{ (row.index + 1) }}
                            </template>
                            <template v-slot:cell(index)="row" v-else>
                                {{ (perPage * (currentPage-1)) + (row.index + 1) }}
                            </template>
                            <!--                            :to="`/edit-category/${row.item.slug}`" @click="editRow"-->
                            <template #cell(action)="row" v-slot:actions="{ rows }">
                                <b-link ml="4" class="text-primary" :to="`/edit-customer/${row.item.id}`"><b-icon icon="pencil-square" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>
                                </b-link>
                                <b-link class="text-danger" @click="remove(row.item.slug)">
                                    <b-icon icon="trash2-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>
                                </b-link>
                            </template>
                            <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage"></b-pagination>
                        </b-table>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col sm="12" md="12" class="mt-0">
                        <b-pagination
                            v-model="currentPage"
                            :total-rows="rows"
                            :per-page="perPage"
                            align="right"
                            size="sm"
                            class="my-0"
                        ></b-pagination>
                    </b-col>
                </b-row>
            </b-card>
            {{ catName }}
        </b-container>
    </div>
</template>
<script>
export default {
    name: "manage",
    data() {
        return {
            form: new Form({
                category_id: null,
                p_name: null,
                p_price: null,
                p_brand: null,
                p_quantity: null,
                p_barcode: null,
                p_status: null,
            }),
            show: false,
            hidenseek: true,
            rawInput: null,
            items: [],
            totalList: 1,
            totalRows: 1,
            perPage: 5,
            currentPage:1,
            pageOptions: [5, 10, 15],
            sortBy: '',
            sortDesc: false,
            sortDirection: 'asc',
            filter: null,
            deletedItem: null,
            filterOn: [],
            collapsed: false,
            pageSize: (this.pageColSize != undefined) ? this.pageColSize : '2',
            searchSize: (this.searchColSize != undefined) ? this.searchColSize : '3',
            fields: [
                { key: 'index', label: 'index'},
                { key: 'category_id', label: 'Category',   name: 'category', sortable: true },
                { key: 'p_name', label: 'Name',   name: 'name', sortable: true },
                { key: 'p_price', label: 'Price',   name: 'price', sortable: true },
                { key: 'p_brand', label: 'Brand',   name: 'brand', sortable: true },
                { key: 'p_quantity', label: 'Quantity',   name: 'quantity', sortable: true },
                { key: 'p_barcode', label: 'Barcode',   name: 'barcode', sortable: true },
                { key: 'p_status', label: 'Status',  name: 'status', sortable: true }, 'action']
        }
    },
    props: ["tbodyTrClass", "pageColSize", "searchColSize", "filterIgnoredFields", 'filterIncludedFields'],
    computed: {
        categories() {
            return this.$store.getters.categories
        },
        products() {
            return this.$store.getters.products
        },
        rows(){
            return this.products.length
        },
        btnVariant: function () {
            return this.collapsed?
                'danger' : 'info'
        },
        btnTxt:  function () {
            return this.collapsed?
                '➖ Close' : '➕ Add';
        },
        catName: function(){
            return this.categories[0].name
        },
    },
    mounted() {
        // By Mounted Hit A Method of actions option of js file
        // Whenever Load The Component Data will get from database
        // By The actions option of js file
        // document.querySelector('#display').style.display = 'none';
        this.$store.dispatch("getProducts");
        this.$store.dispatch("getCategories");
        $('#pdf').tooltip()
        this.$root.$on(
            'bv::collapse::state',
            // id of the collapse component
            // collapse is the state
            // true => open, false => close
            (id, collapsed) => {
                if (id === "my-collapse") {
                    this.collapsed = collapsed;
                }
            });// $on
        // this.editCategory();
    },
    watch: {
        // selected: function (selected) {
        //     // this.visible = true;
        //     if (selected.length > 0)
        //     {
        //         $(function () {
        //             $('[data-toggle="tooltip"]').tooltip()
        //         })
        //         document.querySelector('#display').style.display = 'block';
        //     }else
        //     {
        //         $(function () {
        //             $('[data-toggle="tooltip"]').tooltip('hide')
        //         })
        //         document.querySelector('#display').style.display = 'none';
        //     }
        //     this.isSelected = (selected.length > 0);
        //     this.multiDelete = (selected.length === this.suppliers.length);
        // }
    },
    methods: {
        addProducts: function() {
            // console.log('test');
            let supplier = this;
            this.form.post('/add-suppliers')
                .then((response) => {
                    // console.log(data)
                    // Toast.fire({
                    //     icon: 'success',
                    //     title: 'Category Created successfully'
                    // })
                    toastr.success("Supplier Created successfully")
                    // $('#category-add').modal('hide');
                    this.hideForm = false
                    this.$store.dispatch("getSuppliers")
                    // category.$router.push("/categories");
                    supplier.form.s_name = null;
                    supplier.form.s_phone = null;
                    supplier.form.s_email = null;
                    supplier.form.s_address = null;
                    supplier.form.s_remarks = null;
                })
        },
        editCategory: function() {
            const this_ = this;
            axios.get("/show-category/" + this.$route.params.slug).then((response) => {
                this_.form.fill(response.data[1])
                // console.log(response.data[1])
            }).catch(() => {

            })
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalList = filteredItems.length;
            this.currentPage = 1
        },
        remove: function(slug) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get("remove-supplier/" + slug).then((response) => {
                        this.$store.dispatch("getCategories"),
                            // toastr.success('Category Deleted Successfully !!')
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                    }).catch((error) => {

                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        },
        hide() {
            this.hideForm = false;
        },
        emptyData() {
            return (this.suppliers.length < 1)
        },
        selectAll: function (event) {
            if (event.target.checked === false) {
                this.selected = []
                // document.querySelector('#display').style.display = 'none';
            } else {
                // document.querySelector('#display').style.display = 'block';
                this.suppliers.forEach((supplier) => {
                    if (this.selected.indexOf(supplier.id) === -1)
                    {
                        this.selected.push(supplier.id)
                    }
                })
            }
        },
        removeItems: function (selected) {
            // console.log(selected)
            axios.post("/categories/remove-items",{data: selected}).then((response) => {
                // console.log(response.data)
                this.selected = [],
                    this.multiDelete = false,
                    this.isSelected = false,
                    this.$store.dispatch("getCategories")
                toastr.success(response.data.total + ' Category has been deleted successfully !!')
            }).catch((error) => {

            })
        },
        generatePDF: function()
        {
            //initialize a new instance of jsPDF
            pdfDoc.autoTable({ html: '#example1' })
            // pdfDoc.html("get-categories",15,15)
            pdfDoc.save("pdf.pdf")
            $('#pdf').tooltip('hide')
        }
    }
}

</script>
<style scoped>
    #pdf:hover{
        color: #f9d6d5;
    }
    #s_phone:valid {
    color: green;
}

    #s_phone:invalid {
        color: red;
    }

    #s_email:valid {
        color: green;
    }

    #s_email:invalid {
        color: red;
    }
</style>
