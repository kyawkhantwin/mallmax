import React, { useEffect, useState } from 'react';
import axios from 'axios';
import Spinner from "../Components/Spinner"

const Transaction_detail = ({ orderId }) => {
  const [transactions, setTransactions] = useState([]);
  const [date, setDate] = useState();
  const [time, setTime] = useState();
  const [loader, setLoader] = useState(false);

  console.log('transactions', transactions);

  const handleFetch = () => {
    setLoader(true);
    axios.get('/api/transaction/' + orderId)
      .then(({ data }) => {
        // Assuming data.data contains an array of orders
        const formattedOrders = data.data.map(transaction => {
          const formattedTransaction = {
            ...transaction,
            created_at: new Date(transaction.created_at),
            time: new Date(transaction.created_at).toLocaleTimeString(),
          };

          setDate(new Date(transaction.created_at).toLocaleDateString());
          setTime(new Date(transaction.created_at).toLocaleTimeString());

          return formattedTransaction;
        });

        setTransactions(formattedOrders);
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
  }, [orderId]);

  return (
    <div className=" mt-5">
      <div className="d-flex justify-content-between align-items-center">
        <h2 className="mb-4">Transaction Detail</h2>
        <p className="mb-4">Date: {date} <br />Time:{time}</p>
      </div>

 
      
      <table className="table table-striped  table-bordered table-hover">
        <thead>
          <tr className="bg-primary text-white">
            <th>Image</th>
            <th>Name</th>
            <th>unit price</th>
            <th>Total Quantity</th>
            <th>Total Amount</th>
           
          </tr>
        </thead>
        <tbody>
        {loader &&   
        <tr >
        <td  colSpan={5}><Spinner /></td>  
      </tr>}
           {/* Display spinner while loading */}
          {transactions.map(transaction => (
            <tr key={transaction.id}>
              <td><img src={transaction.product.image_url} className="img-thumbnail" width="70" alt={transaction.product.image} /></td>
              <td>{transaction.product.name}</td>
              <td>{transaction.sale_price} Kyats</td>
              <td>{transaction.total_qty}</td>
              <td>{transaction.sale_price * transaction.total_qty} Kyats</td>
              
            </tr>
          ))}
          <tr>
            <td className='text-end' colSpan={4}>Total Amount</td>
            <td>{transactions.length > 0 ? transactions[0].order.total_price + ' Kyats' : 'N/A'}</td>

          </tr>
        </tbody>
      </table>
    </div>
  );
};

export default Transaction_detail;
