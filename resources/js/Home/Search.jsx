import React, { useEffect, useRef, useState } from "react";
import axios from "axios";
import Spinner from "../Components/Spinner";


export default function Search() {

    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);
    const search = params.get('query');

    const [products, setProducts] = useState([]);
    const [loader, setLoader] = useState(true);

    const fetchProduct = () => {
        axios
            .get("/api/product/search/" + search)
            .then((res) => {
                const productsData = res.data.data.products; // Assuming your API response structure has a 'products' property
                setProducts(productsData);
                setLoader(false);
            })
            .catch((err) => {
                setLoader(false);
                console.error("Error fetching data:", err);
                // You should handle errors appropriately, like displaying a message to the user.
            });
    };

    useEffect(() => {
        fetchProduct();
    }, [search]);

    const minusQty = function (index) {
        const qtyInput = document.querySelectorAll(".quantity")[index];

        if (qtyInput.value > 0) {
            return qtyInput.value--;
        } else {
            showToast("Quantity can't be less than 1 ");
        }
    };

    const plusQty = function (index) {
        const qtyInput = document.querySelectorAll(".quantity")[index];
        const totalQty = products[index].total_qty;

        if (qtyInput.value <= totalQty) {
            qtyInput.value++;
        } else {
            showToast("excessed than total quantity", "error");
        }
    };

    const addToCartApi = function (index, slug, sale_price) {
        const total_qty = document.querySelectorAll(".quantity")[index].value;
        const user_id = window.auth ? window.auth.id : null;
        const cartData = { user_id, slug, total_qty, sale_price };

        if (total_qty < 1) return alert("Quantity can't be less than 0 ");

        axios.post("/api/product/cart/" + slug, cartData).then(({ data }) => {
            if (data.status == "success") {
                window.updateCart(data.data.cartCount);
                showToast("Successfully added to cart", "success");
            } else {
                showToast(data.message, "error");
            }
        });
    };

    return (
        <React.Fragment>
            <div className="row  mt-5 p-0 ">
                <p>Search Result</p>
                {loader && <Spinner />}
                {/*            loop Sale*/}
                {!loader &&
                    products.map((product, index) => (
                        <div
                            className="col-6   col-md-3 col-lg-2 p-0 "
                            key={product.id}
                        >
                            <a
                                href={`/product/detail/${product.slug}`}
                                className="text-decoration-none"
                            >
                                <div className="card border-0  m-1">
                                    <div className="d-flex align-items-center justify-content-center ">
                                        <img
                                            src={product.image_url}
                                            className="img-fluid"
                                            alt=""
                                        />
                                    </div>
                                    <div className=" card-body p-3">
                                        <p className="mb-1 font-md  text-center">
                                            {product.name}
                                        </p>
                                        <p className="text-warning mb-0 ms-lg-2 fs-md-5 font-md text-center">
                                            {product.sale_price} ks
                                        </p>
                                        <div className="text-center mt-1 font-md">
                                            <button
                                                onClick={(e) => {
                                                    e.preventDefault();
                                                    minusQty(index);
                                                }}
                                                className="minus-btn btn text-white btn-primary rounded-0 rounded-start-2  btn-sm ms-xl-2"
                                            >
                                                {" "}
                                                -{" "}
                                            </button>
                                            <input
                                                onClick={(e) =>
                                                    e.preventDefault()
                                                }
                                                type="text"
                                                readOnly
                                                className="quantity w-25 m-0 border-0 text-center p-1 "
                                                value={0}
                                            />
                                            <button
                                                onClick={(e) => {
                                                    e.preventDefault();
                                                    plusQty(index);
                                                }}
                                                className="plus-btn btn btn-primary text-white rounded-0 rounded-end-2 btn-sm"
                                            >
                                                {" "}
                                                +{" "}
                                            </button>
                                        </div>
                                        <div className="font-sm mt-2">
                                            <button
                                                onClick={(e) => {
                                                    e.preventDefault();
                                                    addToCartApi(
                                                        index,
                                                        product.slug,
                                                        product.sale_price
                                                    );
                                                }}
                                                className=" btn btn-primary btn-sm w-100 text-white fs-lg-6"
                                            >
                                                {loader ? (
                                                    <Spinner />
                                                ) : (
                                                    "Add To Cart"
                                                )}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    ))}
            </div>
        </React.Fragment>
    );
}
