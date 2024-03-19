import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router';
import Spinner from "../Components/Spinner"

const Transaction = () => {
  const [orders, setOrders] = useState([]);
  const [loader, setLoader] = useState(false);

  const navigate = useNavigate();

  const handleFetch = () => {
    setLoader(true);
    axios.get('/api/transaction', { params: { user_id: window.auth.id } })
      .then(({ data }) => {
        // Assuming data.data contains an array of orders
        const formattedOrders = data.data.map(transaction => ({
          ...transaction,
          created_at: new Date(transaction.created_at),
          date: new Date(transaction.created_at).toLocaleDateString(),
          time: new Date(transaction.created_at).toLocaleTimeString(),
        }));

        setOrders(formattedOrders);
        console.log(formattedOrders);
      })
      .catch(error => {
        console.error('Error fetching orders:', error.response);
      })
      .finally(() => {
        setLoader(false);
      });
  }

  useEffect(() => {
    // Fetch orders from the API
    handleFetch();
  }, []);

 

  return (
    <div className=" mt-5">
      <h2 className="mb-4">Transaction History</h2>

      

      <table className="table table-striped  table-bordered table-hover">
        <thead>
          <tr className="bg-primary text-white">
            <th>Date</th>
            <th>Time</th>
            <th>Total Amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        {loader &&<tr height={40}>
          <td  colSpan={5}><Spinner /></td>  
        </tr>} {/* Display spinner while loading */}
          {orders.map(order => (
            <tr key={order.id}>
            
              <td>{order.date}</td>
              <td>{order.time}</td>
              <td>{order.total_price} kyats</td>
              <td>
                <button className="btn btn-info text-white btn-sm me-2" >
                  <a className='text-white text-decoration-none' href={"/product/transaction/" + order.id}> View</a>
                  </button>
         
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Transaction;
