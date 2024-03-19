import React from "react";

export default function Spinner(){
    return (
       <React.Fragment>
          <div className="d-flex align-items-center justify-content-center w-100%">
              <div className="spinner-border text-primary " role="status">
                  <span className="sr-only">Loading...</span>
              </div>
          </div>
       </React.Fragment>
    )
}
