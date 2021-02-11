<template>
    <div>
        <b-container>
            <b-collapse id="my-collapse">
                    <b-row id="display">
                        <b-col md="12">
                            <b-card>
                                <b-form @submit.prevent="addCategory">
                                    <b-row>
                                        <b-col md="6">
                                            <b-form-group
                                                id="name"
                                                label="Name"
                                                label-for="name">
                                                <b-form-input
                                                    id="name"
                                                    v-model="form.name"
                                                    :class="{'is-invalid': form.errors.has('name')}"
                                                    type="text"
                                                    placeholder="Enter your name"
                                                ></b-form-input>
                                            </b-form-group>
                                        </b-col>
                                        <b-col md="6">
                                            <b-form-group id="remarks" label="Remarks" label-for="remarks">
                                                <b-form-textarea
                                                    id="remarks"
                                                    v-model="form.remarks"
                                                    :class="{'is-invalid': form.errors.has('remarks')}"
                                                    placeholder="Enter your remarks..."
                                                    rows="1"
                                                    style="height: 2.3rem"
                                                    max-rows="6"
                                                ></b-form-textarea>
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
                            class="mb-0"
                        >
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
                                :debounce="200"
                            ></b-form-input>
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
                                 :items="categories"
                                 :per-page="perPage"
                                 :current-page="currentPage">
                            <template v-slot:cell(index)="row" v-if="currentPage <= 1">
                                {{ (row.index + 1) }}
                            </template>
                            <template v-slot:cell(index)="row" v-else>
                                {{ (perPage * (currentPage-1)) + (row.index + 1) }}
                            </template>
<!--                            :to="`/edit-category/${row.item.slug}`" @click="editRow"-->
                            <template #cell(action)="row" v-slot:actions="{ rows }">
                                <b-link ml="4" class="text-primary" :to="`/edit-category/${row.item.slug}`"><b-icon icon="pencil-square" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>
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
<!--            <b-card>-->
<!--                <b-row>-->
<!--                    <b-col>-->
<!--                        <span href="javascript:void(0)" class="btn btn-info float-right mb-2 btn-sm" id="add"-->
<!--                              v-on:click="show = !show" style="box-shadow: 3px 2px 10px rgba(0,0,0,0.3);">-->
<!--                                    <i class="fas fa-plus-circle"></i> Add-->
<!--                        </span>-->
<!--                    </b-col>-->
<!--                </b-row>-->
<!--                <b-card-body class="border">-->
<!--                    <Datatable v-bind:fields="fields" v-bind:items="categories" :totalList="totalList" :perPage="perPage"-->
<!--                               :primaryKeyColumnName="'id'">-->
<!--                        <template v-slot:actions="{ rows }">-->
<!--                            <b-link ml="4" class="text-primary" :to="`/edit-category/${categories[0].slug}`">-->
<!--                                <b-icon icon="pencil-square" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>-->
<!--                            </b-link>-->
<!--                            <b-link class="text-danger" v-b-modal="'family-remove'" @click="deletedItem = rows.item">-->
<!--                                <b-icon icon="trash2-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>-->
<!--                            </b-link>-->
<!--                        </template>-->
<!--                    </Datatable>-->
<!--                    <b-row>-->
<!--                        <b-col sm="12" md="12" class="mt-0">-->
<!--                            <b-pagination-->
<!--                                v-model="currentPage"-->
<!--                                :total-rows="rows"-->
<!--                                :per-page="perPage"-->
<!--                                align="right"-->
<!--                                size="sm"-->
<!--                                class="my-0"-->
<!--                            ></b-pagination>-->
<!--                        </b-col>-->
<!--                    </b-row>-->
<!--                    <b-modal :id="'family-remove'" :centered="true" title="Please Confirm" size="sm"-->
<!--                             buttonSize="sm" okTitle="YES" cancelTitle="NO" footerClass="p-2"-->
<!--                             :hideHeaderClose="false"-->
<!--                             @ok="deleteRow()" @hidden="deletedItem = null">-->
<!--                        <div>Are you sure you want to delete?</div>-->
<!--                    </b-modal>-->
<!--                </b-card-body>-->
<!--            </b-card>-->
        </b-container>
    </div>
</template>

<script>
    import Datatable from '../../common/datatable';
    export default {
        components: { Datatable },
        name: "manage",
        data() {
            return {
                form: new Form({
                    id: null,
                    name: null,
                    remarks: null,
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
                    { key: 'name', label: 'Name',   name: 'name', sortable: true },
                    { key: 'slug', label: 'Slug',  name: 'slug', sortable: true },
                    { key: 'remarks', label: 'Remarks',  name: 'remarks', sortable: true }, 'action']
            }
        },
        computed: {
            categories() {
                return this.$store.getters.categories
            },
            rows(){
                return this.categories.length
            },
            btnVariant: function () {
                return this.collapsed?
                    'danger' : 'info'
            },
            btnTxt:  function () {
                return this.collapsed?
                    '➖ Close' : '➕ Add';
            }
        },
        mounted() {
            // By Mounted Hit A Method of actions option of js file
            // Whenever Load The Component Data will get from database
            // By The actions option of js file
            // document.querySelector('#display').style.display = 'none';
            this.$store.dispatch("getCategories");
            $('#pdf').tooltip();
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
            selected: function (selected) {
                // this.visible = true;
                if (selected.length > 0)
                {
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                    // document.querySelector('#display').style.display = 'block';
                }else
                {
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip('hide')
                    })
                    // document.querySelector('#display').style.display = 'none';
                }
                this.isSelected = (selected.length > 0);
                this.multiDelete = (selected.length === this.categories.length);
            }
        },
        methods: {
            clear() {
                this.filter = ''
                this.rawInput = '';
            },
            addCategory: function() {
                // console.log('test');
                let category = this;
                this.form.post('/add-category')
                    .then((response) => {
                        // console.log(data)
                        // Toast.fire({
                        //     icon: 'success',
                        //     title: 'Category Created successfully'
                        // })
                        toastr.success("Category Created successfully")
                        // $('#category-add').modal('hide');
                        document.querySelector('#display').style.display = 'none';
                        location.reload();
                        this.$store.dispatch("getCategories")
                        // category.$router.push("/categories");
                        category.form.name = null;
                        category.form.remarks = null;
                    })
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalList = filteredItems.length;
                this.currentPage = 1
            },
            // editCategory: function() {
            //     const this_ = this;
            //     axios.get("/show-category/" + this.$route.params.slug).then((response) => {
            //         this_.form.fill(response.data[1])
            //         // console.log(response.data[1])
            //     }).catch(() => {

            //     })
            // },
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
                        axios.get("remove-category/" + slug).then((response) => {
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
                return (this.categories.length < 1)
            },
            selectAll: function (event) {
                if (event.target.checked === false) {
                    this.selected = []
                    // document.querySelector('#display').style.display = 'none';
                } else {
                    // document.querySelector('#display').style.display = 'block';
                    this.categories.forEach((category) => {
                        if (this.selected.indexOf(category.id) === -1)
                        {
                            this.selected.push(category.id)
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
            },
            deleteRow() {
                if (this.deletedItem !== undefined && this.deletedItem) {
                    ApiRepository.callApi(ApiRepository.DELETE_COMMAND, `/pmis/employee/families/${this.deletedItem.emp_family_id}`).then(res => {
                        if (res.data.o_status_code == 1) {
                            this.$notify({group: 'pmis', text: res.data.o_status_message, type: 'success'});
                        } else {
                            this.$notify({group: 'pmis', text: res.data.o_status_message, type: 'error'});
                        }

                        this.deletedItem = null;
                        this.loadData();
                        this.onReset();
                    }).catch(err => {
                        this.deletedItem = null;
                        console.log(err);
                    });
                }
            },
            removeRow(index) {
                this.categories.splice(index,1)
            }
        }
    }

</script>
<style scoped>

</style>
