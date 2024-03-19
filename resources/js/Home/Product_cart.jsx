import React, { useEffect, useState } from "react";
import axios from "axios";
import Spinner from "../Components/Spinner";

export default function Product_cart() {
  const [carts, setCarts] = useState([]);
  const [totalPrice, setTotalPrice] = useState(0);
  const [loader, setLoader] = useState(false);

  const fetchCart = () => {
    setLoader(true);
      axios.get("/api/product/cart/" + window.auth.slug).then(({ data }) => {
        showToast(data.message, 'success');
        setCarts(data.data);
        setLoader(false);
    }).catch((error) => {
        showToast(error.message, 'error');
        setLoader(false);
    });     
};

  const updateQty = (id, type) => {
    setCarts((prevCarts) =>
      prevCarts.map((item) =>
        item.id === id
          ? {
              ...item,
              total_qty: type === "add" ? item.total_qty + 1 : item.total_qty - 1,
            }
          : item
      )
    );
  };

  const calculateTotalPrice = () => {
    const total = carts.reduce(
      (acc, cart) => cart.sale_price * cart.total_qty + acc,
      0
    );
    setTotalPrice(total);
  };

  const deleteCart = (cart_id) => {
    const data = { cart_id };

    axios
      .delete("/api/product/cart/" + window.auth.slug , { data })
      .then(({ data }) => {
        console.log(data);
        window.updateCart(data.data.cartsCount);
        setCarts(data.data.carts);
        setLoader(false);
        showToast(data.message, 'success');
      })
      .catch((error) => {
        showToast(error.message, 'error');
        setLoader(false);
      });
  };

  const handleCheckOut = ()=>{
    const user_id = window.auth.id;
    const cartDetail = [];
    
    carts.map(cart => {



        cartDetail.push({
            product_id: cart.product_id,
            sale_price: cart.sale_price,
            total_qty: cart.total_qty,
        });
       
    });

    
    
    const data = {
        user_id: user_id,
        cartDetail: cartDetail,
        total_price: totalPrice
    };


    
    axios.post("/api/transaction", data)
        .then(({ data }) => {
            if (data.status === 'success') {
                
                showToast(data.message, 'success');
            } else {
              console.log(data);
                showToast(data.message, 'error');
            }
        })
        .catch((error) => {
            console.log(error.response);
            showToast(error.response , 'error');
        }).finally(()=>{
          setLoader(loader)
        });


  
    
    axios
      .delete("/api/product/carts/delete/"+ user_id)
      .then(({ data }) => {
        console.log(data);
        window.updateCart(data.data.cartsCount);
        setCarts(data.data.carts);
        setLoader(false);
        showToast(data.message, 'success');
      })
      .catch((error) => {
        showToast(error.message, 'error');
        setLoader(false);
      });

  
   
   
  }


  useEffect(()=>{
   fetchCart()
  },[])

  useEffect(() => {
  
    calculateTotalPrice();
  }, [carts]);

  return (
    <div>
      <h2 className="my-4">Product Cart</h2>
    <div
      className="d-flex align-items-center justify-content-center mb-5"
      style={{ minHeight: " 65vh" }}
    >
      <table className="table table-striped table-bordered table-hover bg-white">
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Single Price</th>
            <th>Total Price</th>
            <th>Total Qty</th>
            <th>Del</th>
          </tr>
        </thead>
        <tbody className="mt-2">
          {loader && <Spinner />}

          {!loader && 
          carts.length === 0 && 
            <tr >
                <td colSpan={6}>
                   <h3 className="text-center py-5">No items in the cart</h3>
                </td>
            </tr>
            }

          {!loader &&
            carts.length > 0 &&
            carts.map((cart) => (
              <tr key={cart.id}>
                <td>
                  <img src={cart.product.image_url} width={50} alt={cart.product.image_url} />
                </td>
                <td>{cart.product.name}</td>
                <td>{cart.sale_price} ks</td>
                <td>{cart.sale_price * cart.total_qty} ks</td>
                <td>
                  <input
                    type="number"
                    className="d-md-none w-50 text-center border-0"
                    defaultValue={0}
                  />
                  <button
                    disabled={cart.total_qty === 1}
                    className="d-none d-md-inline-block btn text-white btn-primary rounded-0 rounded-start-2 btn-sm"
                    onClick={() => {
                      updateQty(cart.id, "reduce");
                    }}
                  >
                    -
                  </button>
                  <span className="d-none d-md-inline m-sm-2">{cart.total_qty}</span>
                  <button
                    className="d-none d-md-inline-block btn btn-primary text-white rounded-0 rounded-end-2 btn-sm"
                    onClick={() => {
                      updateQty(cart.id, "add");
                    }}
                  >
                    +
                  </button>
                </td>
                <td onClick={() => deleteCart(cart.id)}>
                  <i className="fa-solid fa-trash text-danger" />
                </td>
              </tr>
            ))}
          <tr>
            <th colSpan={2} />
            <th colSpan={2} className="p-2 p-md-3">
              <p className="h4">Total Price :</p>
            </th>
            <th className="p-0" colSpan={2}>
              <h4 className="text-warning p-2 p-md-3 m-0">{totalPrice} kyats</h4>
            </th>
          </tr>
        </tbody>
      </table>
    </div>
    <button onClick={()=>handleCheckOut()} className="btn btn-primary rounded float-end p-3">Checkout</button>
    </div>
  );
}
