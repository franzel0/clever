@extends('layouts.app')

@section("scripts")
    <script>
    new Vue({
        el: '#demo',

        data: {
            sortKey: 'name',

            reverse: false,

            search: '',

            columns: ['name', 'age'],

            newUser: {},

            users: [
                { name: 'John', age: 50 },
                { name: 'Jane', age: 22 },
                { name: 'Paul', age: 34 },
                { name: 'Kate', age: 15 },
                { name: 'Amanda', age: 65 },
                { name: 'Steve', age: 38 },
                { name: 'Keith', age: 21 },
                { name: 'Don', age: 50 },
                { name: 'Susan', age: 21 }
            ]
        },

        methods: {
            sortBy: function(sortKey) {
                this.reverse = (this.sortKey == sortKey) ? ! this.reverse : false;

                this.sortKey = sortKey;
            },

            addUser: function() {
                this.users.push(this.newUser);
                this.newUser = {};
            }
        }
    });
    </script>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Zum Testen
        </div>
        <div class="panel-body">
            <div class="row" style="padding:10px;">
                <div class="col-md-6">
                    <div class="well">
                        <ul>
                            @foreach ($tags as $key => $tag)
                                <li>
                                    {{$tag->name}} ({{ $tag->tag_count }})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <ul>
                            @foreach ($tags1 as $key => $tag)
                                <li>
                                    {{$tag->name}} ({{ $tag->tag_count }})
                                </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
