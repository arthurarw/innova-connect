<template>
    <div>
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2><b>Person Details</b></h2></div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>Administration</td>
                        <td>
                            <a href="#"><i class="fas fa-user-edit"></i></a>
                            <a href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Peter Parker</td>
                        <td>Customer Service</td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i
                                class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i
                                class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Fran Wilson</td>
                        <td>Human Resources</td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i
                                class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i
                                class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Grid"
}
</script>

<style scoped>

</style>
