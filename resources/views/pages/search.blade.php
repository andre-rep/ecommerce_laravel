@extends('layouts.adminLayout')
@section('content')
    @include('includes.header')
    <section class="search-ctn">
        <div class="search">
            <div class="search-wrapper">
                <div class="search-wrapper-header">
                    <span>Mostrando 1-16 de 24 Produtos</span>
                    <div class="search-wrapper-header-buttons">
                        <button>{{$paginate}}</button>
                        <button>Ordenação Padrão</button>
                    </div>
                </div>
                <div class="search-wrapper-body">
                    @foreach ($products as $product)
                        <div class="search-wrapper-product">
                            <a class="search-product-link" href="/product/{{$product->product_url}}">
                                
                            </a>
                            <div class="search-wrapper-product-image">
                                <img src="{{asset($product->product_image_url)}}">
                            </div>
                            <div class="search-product-desc-ctn">
                                <div class="search-product-description">
                                    <span class="product-name">{{$product->product_name}}</span>
                                    <span>R${{$product->product_price}}.00</span>
                                    <div class="main-novidades-product-rate">
                                        <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                        <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                        <i class="fa fa-star" style="color:rgb(250,196,70)"></i>
                                        <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                        <i class="fa fa-star" style="color:rgb(203,203,203)"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="filters-wrapper">
                <h4>Filtrar Por</h4>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color: transparent;color:#000">
                                Marcas
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach($productsBrands as $productsBrand)
                                    <div class="form-check">
                                        <input class="form-check-input brand-check" type="checkbox" value="{{$productsBrand->product_brand_name}}" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            {{$productsBrand->product_brand_name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" style="background-color: transparent;color:#000">
                                Preço
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Abaixo de R$50,00
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        R$50 - R$100
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        R$100 - R$200
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Acima de R$200
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="background-color: transparent;color:#000">
                                Categoria
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach($productsCategories as $productsCategory)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{$productsCategory->product_category_name}}" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            {{$productsCategory->product_category_name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination-ctn">
                <div class="pagination">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </section>
    <script>
        //instantiate a method to work with url params
        const urlParams = new URLSearchParams(window.location.search);
        //query strings values stored in arrays
        var brands = urlParams.getAll('filterByBrand[]');
        var categories = urlParams.getAll('filterByCategory[]');
        //brandcheck elements from class
        var brandCheck = document.getElementsByClassName('brand-check');

        //trigger for clicking on a brand check
        for(var i=0; i<brandCheck.length; i++){
            brandCheck[i].onclick = function(target){
                if(this.checked){
                    urlParams.append('filterByBrand[]', this.value);
                    window.location.assign("http://localhost:8000/search?" + urlParams.toString());
                }else{
                    urlParams.delete('filterByBrand[]');
                    brands.forEach(function(brand, i){
                        if(brand == this.value)
                            brands.splice(i, 1);
                    });
                    brands.forEach(function(brand,i){
                        urlParams.append('filterByBrand[]', brand);
                    });
                    window.location.assign("http://localhost:8000/search?" + urlParams.toString());
                }
            }
        }

        //limit the length of the product name 20
        for(var i=0; i<20; i++){
            var productName = document.getElementsByClassName('product-name')[i];
            var substring = productName.textContent.substring(0, 70);
            productName.innerHTML = substring;
        }
    </script>
    @include('includes.facilities')
    @include('includes.footer')
    @include('includes.copyright')
@endsection