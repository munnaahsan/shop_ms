<template>
    <div>
        <b-container>
<!--            <b-form @submit="onSubmit" @reset="onReset" v-if="show">-->
<!--                <b-form-group-->
<!--                    id="input-group-1"-->
<!--                    label="Email address:"-->
<!--                    label-for="input-1"-->
<!--                    description="We'll never share your email with anyone else.">-->
<!--                    <b-form-input-->
<!--                        id="input-1"-->
<!--                        v-model="form.email"-->
<!--                        type="email"-->
<!--                        placeholder="Enter email"-->
<!--                        required-->
<!--                    ></b-form-input>-->
<!--                </b-form-group>-->

<!--                <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">-->
<!--                    <b-form-input-->
<!--                        id="input-2"-->
<!--                        v-model="form.name"-->
<!--                        placeholder="Enter name"-->
<!--                        required-->
<!--                    ></b-form-input>-->
<!--                </b-form-group>-->

<!--                <b-form-group id="input-group-3" label="Food:" label-for="input-3">-->
<!--                    <b-form-select-->
<!--                        id="input-3"-->
<!--                        v-model="form.food"-->
<!--                        :options="foods"-->
<!--                        required-->
<!--                    ></b-form-select>-->
<!--                </b-form-group>-->

<!--                <b-form-group id="input-group-4" v-slot="{ ariaDescribedby }">-->
<!--                    <b-form-checkbox-group-->
<!--                        v-model="form.checked"-->
<!--                        id="checkboxes-4"-->
<!--                        :aria-describedby="ariaDescribedby"-->
<!--                    >-->
<!--                        <b-form-checkbox value="me">Check me out</b-form-checkbox>-->
<!--                        <b-form-checkbox value="that">Check that out</b-form-checkbox>-->
<!--                    </b-form-checkbox-group>-->
<!--                </b-form-group>-->

<!--                <b-button type="submit" variant="primary">Submit</b-button>-->
<!--                <b-button type="reset" variant="danger">Reset</b-button>-->
<!--            </b-form>-->
            <data-table
                v-bind:columns="columns" v-bind:categories="categories"
                url="/get-categories">
            </data-table>
        </b-container>
    </div>
</template>

<script>
    export default {
        name: "manage",
        data() {
            return {
                form: new Form({
                    name: null,
                    slug: null,
                    remarks: null,
                }),
                show: true,
                perPage: 5,
                items: [],
                totalList: 1,
                columns: [
                    { key: 'index', label: 'Sl. No.'},
                    { key: 'name', label: 'Name',   name: 'name', orderable: true },
                    { key: 'slug', label: 'Slug',  name: 'slug', orderable: true },
                    { key: 'remarks', label: 'Remarks',  name: 'remarks', orderable: true },
                    { label: 'Action',  name: 'action', orderable: true },
                ]
            }
        },
        computed: {
            categories() {
                return this.$store.getters.categories
            }
        },
        mounted() {
            // By Mounted Hit A Method of actions option of js file
            // Whenever Load The Component Data will get from database
            // By The actions option of js file
            // document.querySelector('#display').style.display = 'none';
            this.$store.dispatch("getCategories");
            $('#pdf').tooltip()
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
                        this.hideForm = false
                        this.$store.dispatch("getCategories")
                        // category.$router.push("/categories");
                        category.form.name = null;
                        category.form.remarks = null;
                    })
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
            }
        }
    }

</script>
<style scoped>

</style>
