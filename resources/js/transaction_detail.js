import React from 'react';
import { HashRouter, Route, Routes } from 'react-router-dom';
import { createRoot } from 'react-dom/client';
import Transaction_detail from './Home/Transaction_detail';

const root = document.getElementById('root');
const orderId =  root.dataset.orderId
export const MainRouter = () => {
  return (
    <HashRouter>
      <Routes>
        <Route path={'/'} element={<Transaction_detail orderId={orderId} />}  />
      </Routes>
    </HashRouter>
  );
};


createRoot(root).render(<MainRouter />);
