@extends('layouts.app')

@section("scripts")
    <script>
    new Vue({
        el: '#testtable',
        data: {
            sortKey: 'name',

            reverse: false,

            search: '',

            columns: ['Name', 'E-Mail', 'Rolle', 'Bereich', ''],

            newUser: {},

            users: {!! json_encode($users) !!}
        },

        methods: {

        },
        computed: {
            filteredUsers: function () {
                var self = this
                return self.users.filter(function (user) {
                    return user.lastname.toLowerCase().indexOf(self.search.toLowerCase()) !== -1 || user.firstname.toLowerCase().indexOf(self.search.toLowerCase()) !== -1
                })
            }
        }
    });
    </script>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Benutzer </div>
        <div class="panel-body">
            <div id="testtable">
                Filtern: <input v-model="search" class="form-control" placeholder="Filter users by name or age">
                <br />
                <table class="table table-striped">
                    <tr>
                        <th v-for="column in columns">
                            @{{ column | capitalize }}
                        </th>
                    </tr>
                    <tr v-for="user in filteredUsers ">
                        <td>
                            @{{ user.firstname }} @{{ user.lastname }}
                        </td>
                        <td>
                            @{{ user.email }}
                        </td>
                        <td>
                            @{{ user.role.name }}
                        </td>
                        <td>
                            @{{ user.section.name }}
                        </td>
                        <td align="center">
                            <a :href="'/user/' + user.id + '/edit'" class="btn btn-danger">Bearbeiten</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
