<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="container">
        <br>
        <h2>Объявлении</h2>
        <hr/>

        @include('components.message')


        <div class="row">
            <div class="col-12">
                <div class="card bg-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="" class="btn btn-primary mb-2" role="button" data-toggle="modal"
                                   data-target="#staticBackdropAdt"><i class="far fa-plus-square"></i> Создать</a>
                            </div>
                            @include('adt.create')
                            <div class="col-md-6">
                                <form style="display: flex; justify-content: flex-end;">
                                    <div class="form-group">
                                        <select class="custom-select" wire:model="paginate">
                                            <option value="">Количество строк</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="search" wire:model="search" class="form-control ml-3"
                                               placeholder="Поиск">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        <label style="cursor: pointer" for="name">
                                            <input type="checkbox" id="name" wire:model="orderBy" class="d-none">
                                            Наименование @if ($orderBy == 1)

                                                <i class="fas fa-arrow-up"></i>
                                            @else
                                                <i class="fas fa-arrow-down"></i>
                                            @endif
                                        </label>
                                    </th>
                                    <th>
                                        <label style="cursor: pointer" for="name">
                                            <input type="checkbox" id="name" wire:model="created_at" class="d-none">
                                            Дата @if ($created_at == 1)

                                                <i class="fas fa-arrow-up"></i>
                                            @else
                                                <i class="fas fa-arrow-down"></i>
                                            @endif
                                        </label>
                                    </th>

                                    <th>
                                        <label style="cursor: pointer" for="price">
                                            <input type="checkbox" id="price" wire:model="price_filter" class="d-none">
                                            Цена @if ($price_filter == 1)

                                                <i class="fas fa-arrow-up"></i>
                                            @else
                                                <i class="fas fa-arrow-down"></i>
                                            @endif
                                        </label>
                                    </th>
                                    {{--                                    <th class="text-right">Действие</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($adts as $item)
                                    <tr>
                                        <th scope="row">
                                            {{ ($adts ->currentpage()-1) * $adts ->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>
                                            <a href="{{route('adt',$item->slug)}}"> {{ $item->title }}</a>
                                        </td>
                                        <td>{{ Date::parse($item->created_at)->format('j F Y г.') }}</td>
                                        <td>{{ number_format($item->price )}} T</td>

                                        {{--                                        <td class="text-right">--}}

                                        {{--                                            <a class="btn btn-warning" role="button" data-toggle="modal" data-target="#staticBackdropArticle" wire:click="edit({{$item->id}})"><i class="fa fa-edit"></i></a>--}}

                                        {{--                                            <button type="submit" class="btn btn-danger" onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" wire:click="destroy({{$item->id}})"><i--}}
                                        {{--                                                    class="far fa-trash-alt"></i></button>--}}
                                        {{--                                        </td>--}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                            <div class="py-4">
                                {{$adts->links("pagination::bootstrap-4")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
