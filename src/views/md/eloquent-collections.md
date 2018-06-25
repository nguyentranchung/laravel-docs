# Eloquent: Collections

- [Giới thiệu](#introduction)
- [Danh sách các hàm](#available-methods)
- [Tạo collection riêng](#custom-collections)

<a name="introduction"></a>
## Giới thiệu

Tất cả các tập hợp nhiều kết quả bởi Eloquent đều là một instance từ `Illuminate\Database\Eloquent\Collection`, bao gồm kết quả lấy từ hàm `get` hay thông qua relationship. Các Eloquent collection object kế thừa từ Laravel [base collection](https://laravel.com/docs/master/collections), nên chúng đề kế thừa các hàm để làm xử lý với lớp dưới của Eloquent model.

Tất nhiên là các collections đều có thể sử dụng như iterators, cho phép bạn thực hiện lặp như với một mảng PHP:

    $users = App\User::where('active', 1)->get();

    foreach ($users as $user) {
        echo $user->name;
    }

Tuy nhiên, collection còn mạnh hơn array nhiều và cung cấp thêm một số các xử lý map / reduce mà có thể móc nối được qua một interface dễ hiểu. Ví dụ, cùng nhau xoá các model inactive và thu thập tên của các user còn lại:

    $users = App\User::where('active', 1)->get();

    $names = $users->reject(function ($user) {
        return $user->active === false;
    })
    ->map(function ($user) {
        return $user->name;
    });

> **Chú ý:** Trong khi hầu hết hàm Eloquent collection  trả về một instance mới của một Eloquent collection, các hàm `pluck`, `keys`, `zip`, `collapse`, `flatten` và `flip` trả về một instance của [base collection](https://laravel.com/docs/master/collections).

<a name="available-methods"></a>
## Danh sách các hàm

### Base Collection

Tất cả các Eloquent collections đều kế thừa từ [Laravel collection](https://laravel.com/docs/master/collections), vì thế mà chúng kế thừa tất cả các hàm mạnh mẽ được cung cấp bởi lớp base collection:

<style>
    #collection-method-list > p {
        column-count: 3; -moz-column-count: 3; -webkit-column-count: 3;
        column-gap: 2em; -moz-column-gap: 2em; -webkit-column-gap: 2em;
    }

    #collection-method-list a {
        display: block;
    }
</style>

<div id="collection-method-list" markdown="1">
[all](https://laravel.com/docs/master/collections#method-all)
[chunk](https://laravel.com/docs/master/collections#method-chunk)
[collapse](https://laravel.com/docs/master/collections#method-collapse)
[contains](https://laravel.com/docs/master/collections#method-contains)
[count](https://laravel.com/docs/master/collections#method-count)
[diff](https://laravel.com/docs/master/collections#method-diff)
[each](https://laravel.com/docs/master/collections#method-each)
[every](https://laravel.com/docs/master/collections#method-every)
[filter](https://laravel.com/docs/master/collections#method-filter)
[first](https://laravel.com/docs/master/collections#method-first)
[flatten](https://laravel.com/docs/master/collections#method-flatten)
[flip](https://laravel.com/docs/master/collections#method-flip)
[forget](https://laravel.com/docs/master/collections#method-forget)
[forPage](https://laravel.com/docs/master/collections#method-forpage)
[get](https://laravel.com/docs/master/collections#method-get)
[groupBy](https://laravel.com/docs/master/collections#method-groupby)
[has](https://laravel.com/docs/master/collections#method-has)
[implode](https://laravel.com/docs/master/collections#method-implode)
[intersect](https://laravel.com/docs/master/collections#method-intersect)
[isEmpty](https://laravel.com/docs/master/collections#method-isempty)
[keyBy](https://laravel.com/docs/master/collections#method-keyby)
[keys](https://laravel.com/docs/master/collections#method-keys)
[last](https://laravel.com/docs/master/collections#method-last)
[map](https://laravel.com/docs/master/collections#method-map)
[merge](https://laravel.com/docs/master/collections#method-merge)
[pluck](https://laravel.com/docs/master/collections#method-pluck)
[pop](https://laravel.com/docs/master/collections#method-pop)
[prepend](https://laravel.com/docs/master/collections#method-prepend)
[pull](https://laravel.com/docs/master/collections#method-pull)
[push](https://laravel.com/docs/master/collections#method-push)
[put](https://laravel.com/docs/master/collections#method-put)
[random](https://laravel.com/docs/master/collections#method-random)
[reduce](https://laravel.com/docs/master/collections#method-reduce)
[reject](https://laravel.com/docs/master/collections#method-reject)
[reverse](https://laravel.com/docs/master/collections#method-reverse)
[search](https://laravel.com/docs/master/collections#method-search)
[shift](https://laravel.com/docs/master/collections#method-shift)
[shuffle](https://laravel.com/docs/master/collections#method-shuffle)
[slice](https://laravel.com/docs/master/collections#method-slice)
[sort](https://laravel.com/docs/master/collections#method-sort)
[sortBy](https://laravel.com/docs/master/collections#method-sortby)
[sortByDesc](https://laravel.com/docs/master/collections#method-sortbydesc)
[splice](https://laravel.com/docs/master/collections#method-splice)
[sum](https://laravel.com/docs/master/collections#method-sum)
[take](https://laravel.com/docs/master/collections#method-take)
[toArray](https://laravel.com/docs/master/collections#method-toarray)
[toJson](https://laravel.com/docs/master/collections#method-tojson)
[transform](https://laravel.com/docs/master/collections#method-transform)
[unique](https://laravel.com/docs/master/collections#method-unique)
[values](https://laravel.com/docs/master/collections#method-values)
[where](https://laravel.com/docs/master/collections#method-where)
[whereLoose](https://laravel.com/docs/master/collections#method-whereloose)
[zip](https://laravel.com/docs/master/collections#method-zip)
</div>

<a name="custom-collections"></a>
## Tạo collection riêng

Nếu bạn muốn tạo một object `Collection` riêng với hàm mở rộng riêng, bạn có thể ghi đè hàm `newCollection` trong model:

    <?php

    namespace App;

    use App\CustomCollection;
    use Illuminate\Database\Eloquent\Model;

    class User extends Model
    {
        /**
         * Create a new Eloquent Collection instance.
         *
         * @param  array  $models
         * @return \Illuminate\Database\Eloquent\Collection
         */
        public function newCollection(array $models = [])
        {
            return new CustomCollection($models);
        }
    }

Khi bạn đã khai báo một hàm `newCollection`, bạn sẽ nhận được một instance của collection đó bất cứ khi nào Eloquent trả về một `Collection` của model. Nếu bạn muốn sử dụng collection riêng cho tất cả các model trong ứng dụng, bạn nên ghi đè vào hàm `newCollection` trong class base của model, mà được kế thừa từ tất cả các model khác.
