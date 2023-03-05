@extends('layouts.app')

@section("scripts")
    <script>
    new Vue({
        el: '#tagtable',
        data: {

            search: '',

            columns: ['Name', ''],

            tags: {!! json_encode($tags) !!}
        },

        computed: {
            filteredTags: function () {
                var self = this
                return self.tags.filter(function (tag) {
                    return tag.name.toLowerCase().indexOf(self.search.toLowerCase()) !== -1
                })
            }
        }
    });
    </script>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Tags </div>
        <div class="panel-body">
            <div id="tagtable">
                Filtern: <input v-model="search" class="form-control" placeholder="Filter tags by name or age">
                <br />
                <table class="table table-striped">
                    <tr>
                        <th v-for="column in columns">
                            @{{ column | capitalize }}
                        </th>
                    </tr>
                    <tr v-for="tag in filteredTags ">
                        <td>
                            @{{ tag.name }} 
                        </td>
                        <td align="center">
                            <a :href="'/tag/' + tag.id + '/edit'" class="btn btn-danger">Bearbeiten</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
