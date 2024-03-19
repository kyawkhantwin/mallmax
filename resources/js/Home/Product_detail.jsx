import React, {useEffect, useRef, useState} from "react";
import axios from "axios";
import Spinner from "../Components/Spinner";
import StarRatings from 'react-star-ratings';
import ReviewFrom from "./ReviewFrom";

export default function Product_detail(props){
    const [loader,setLoader] = useState(true);
    const [product,setProduct]= useState([]);
    const [productReviews,setProductReviews] = useState([]);
    const [randProducts,setRandProducts] = useState([]);
    const [total_qty,setTotalQuanity] = useState(0);
    const slug = props.slug;
    const getApi = function () {
        axios.get(`/api/product/`+ slug).then(({data}) => {
            const {productDetail,productReviews,randProducts} = data.data;
            setProduct(productDetail);
            setRandProducts(randProducts);
            setProductReviews(productReviews);
            setLoader(false)
        }).catch(err=>{
            console.log(err.message);
        });
    };

    const plusQty = () => {
        if(total_qty < product.total_qty){
            setTotalQuanity((q) => q+1);
        }
      };

      const minusQty = (e) => {
        if (total_qty > 0) {
          setTotalQuanity((q) => q - 1);
        }
      };

    useEffect(()=>{
        getApi()
    },[])

    const handleAddToCart =  function(){
        const user_id = window.auth ? window.auth.id : null ;
        const cartData = {
            user_id, 
            slug,
            total_qty,
            sale_price: product.sale_price };


        axios.post("/api/product/cart/" + slug, cartData).then(({ data }) => {
            if (data.status == "success") {
                console.log(data)
                window.updateCart(data.data.cartCount);
                showToast(data.message,'success');
            } else {
                showToast(data.message,'error');
            }
        });
    }

    return (
        <React.Fragment>
            {loader && <Spinner/> }

            {!loader &&(
                //About Product
                <div className="container ">
                    <div className="row  bg-white rounded py-md-5">
                        <div className="col-12 col-md-9 ">
                            {/*            Product Detail*/}
                            <div className="row">
                                {/*                image*/}
                                <div className="col-12 col-md-6">
                                    <img
                                        src={product.image_url}
                                        className="img-fluid"
                                        alt={product.name}
                                    />
                                </div>
                                {/*                Detail*/}
                                <div className="col-12 mt-4 mt-md-0 col-md-6">
                                    <h3>{product.name}</h3>
                                    {/*rating*/}
                                    <span className="mt-2" id='productRate' style={{ fontSize: 13 }}>
                                     <i className="fa-solid fa-star text-warning" />
                                     <i className="fa-solid fa-star text-warning" />
                                     <i className="fa-solid fa-star text-warning" />
                                     <i className="fa-solid fa-star" />
                                     <i className="fa-solid fa-star" />
                                    <span className="text-info ms-2 fs-6"> {product.rate} rated</span>
                                </span>
                                    <p className="mt-2 ">Brand :{product.brand}</p>
                                    <div className="d-flex align-items-center justify-content-start d-md-block">
                                        <del className="text-muted ">{product.sale_price} ks</del>
                                        <h2 className=" h2  m-0  text-warning ms-3 ms-md-0">{product.sale_price - product.discount_price} ks</h2>

                                        <p className="m-0   ms-3 ms-md-0 mt-2">In stock :{product.total_qty}</p>
                                    </div>
                                    <br />
                                    <div className="d-flex justify-content-start align-items-center mt-md-3">
                                        <p className="mt-1 mt-md-3">quantity:</p>
                                        <div className=" ms-4">
                                            <button disabled={total_qty === 0} onClick={minusQty} className="btn px-3 btn-primary text-white" >-</button>
                                            <button className="btn border-0 px-3" disabled>
                                                { total_qty }
                                            </button>
                                            <button onClick={plusQty} className="btn px-3 btn-primary text-white">+</button>
                                        </div>
                                    </div>
                                    <div className="mt-4 ms-2 ms-md-0 d-block mb-3">
                                        <button className="btn btn-primary text-white px-4 px-md-2 px-lg-4" onClick={()=>handleAddToCart()}>
                                            Add To cart
                                        </button>
                                        <button className="btn  btn-outline-info px-4 px-md-2  px-lg-4 ms-3 ">
                                            Buy Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {/*Delivery Detail*/}
                        <div className=" col-12 col-md-3 mt-3 mt-md-0"
                             style={{ borderLeft: "1px solid #dee2e6" }} >
                            <div className="d-flex align-items-start justify-content-start justify-content-lg-evenly d-md-block">
                                {/*            Delivery*/}
                                <div className="my-md-4">
                                    <h6>Delivery</h6>
                                    <ul className="list-group-flush ps-0 mt-2">
                                        <li className="list-group-item d-flex  justify-content-start align-items-baseline align-items-md-center justify-content-md-between mt-2">
                                            <div>
                                                <i className="fa-solid fa-map" />
                                                <span className="text-muted ms-2 ">user.address</span>
                                            </div>
                                        </li>
                                        <li className="list-group-item mt-2 ">
                                            <i className="fa-solid fa-truck-fast" />
                                            <span className="ms-2 text-muted"> Delivery 1500 kyats</span>
                                        </li>
                                        <li className="list-group-item mt-2 ">
                                            <i className="fa-solid fa-money-bill" />
                                            <span className="ms-2 text-muted"> Cash On delivery available</span>
                                        </li>
                                    </ul>
                                </div>
                                {/*            Service Info*/}
                                <hr className="ms-2 d-md-none"
                                    style={{
                                        border: "none", borderRight: "1px solid black",
                                        height: 120, margin: 0,
                                    }} />
                                <div className="my-md-4 ms-3 ms-md-0">
                                    <h6>Service</h6>
                                    <ul className="list-group-flush  ps-0 mt-2">
                                        <li className="list-group-item mt-2">
                                            <i className="fa-solid fa-rotate-right" />
                                            <span className="ms-2 text-muted">7 days Return</span>
                                        </li>
                                        <li className="list-group-item mt-2">
                                            <i className="fa-solid fa-shield" />
                                            <span className="ms-2 text-muted">Warranty Not Available</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                {/*//Product description and comment*/}
                    <div className="row bg-white rounded pt-3 mt-3 p-md-4">
                        <div className="col-md-8 col-lg-9">
                            {/*       Description*/}
                            <div>
                                <h3>Product Description</h3>
                                <div className="mt-3 d-flex align-items-center justify-content-between w-50">
                                    {product.description}
                                </div>
                            </div>
                            {/*       Review */}
                            <ReviewFrom reviews={productReviews} slug={slug}/>
                        </div>
                        {/*        split */}
                        <div className="col-12 col-md-1  p-0 px-md-1 mt-md-0   p-lg-0 spilt">
                             <span
                                 className="d-block"
                                 style={{ width: "100%", height: "100%", backgroundColor: "#efefef" }}
                             />
                        </div>
                        {/*        Seller form shop*/}
                        <div className="col-12  col-md-3 col-lg-2 mt-lg-0">
                            <h5>Sell From This Shop</h5>
                            <div className="mt-3 d-flex align-items-center justify-content-center  d-md-block overflow-scroll">
                                {/*                LOOP sell from shop*/}

                                    {randProducts.map(product =>
                                            <a href={product.slug} key={product.name} className="text-decoration-none text-black border mx-2 p-0 mb-3 rounded" >
                                                <img
                                                    src={product.image_url}

                                                    alt={product.name}
                                                    className='img-fluid'
                                                />
                                                <div className=" p-3">
                                                    <p className="fs-5 mt-2 mb-1" style={{ width: '130px',

                                                        overflow: 'hidden',
                                                        textOverflow: 'ellipsis'
                                                    }}>{product.name}</p>
                                                    <span className="text-warning mt-2">{product.sale_price} ks</span>
                                                </div>
                                            </a>


                                        )}
                            </div>
                        </div>
                    </div>
                </div>

            )}

        </React.Fragment>
    );
}
