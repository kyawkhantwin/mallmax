import StarRatings from "react-star-ratings";
import {useEffect, useState} from "react";
import Spinner from "../Components/Spinner";
import axios from "axios";

export default function ReviewFrom ({reviews , slug}){
    const [reviewList, setReviewList] = useState(reviews)
    const [rating,setRating] = useState(0);
    const [review,setReview] = useState('');//user
    const [loader,setLoader] = useState(false);
    const disableReview = rating && review  ? false : true;

    const makeReview = ()=>{
        setLoader(true)
        const user_id = window.auth.id;
        const review_data = {review,user_id, slug,rating}
        axios.post('/api/make-review/' + slug, review_data).then(({ data }) => {
                setLoader(false);
                 if (data.status == 'success'){

                     setReviewList([...reviewList, ...data.review])
                     setRating('')
                     setReview('')
                     document.getElementById('text-review').value= '';

                 }else{
                     alert(data.message)
                 }


            });
    }
        return (
        <div className="mt-3 ">
            <h3 >Product Review</h3>
            {/* if ther is no userList */}
            {reviewList == 0 && (

                <h5 className="text-muted text-center mt-5"> This product doesn't have reivew yet!</h5>

            )}
            {loader && <Spinner/>}
            {/*User Review For Loop*/}
            {!loader && reviewList.length > 0 ?   (

                reviewList.map((review, index) => (
                    <div className="mt-3" key={review.id}>
                        <div className="d-flex align-items-center">
                            <img
                                className="rounded-circle"
                                src={review.user.name}
                                width={50}
                                height={50}
                                alt={review.user.name}
                            />
                            <div className="ps-3">
                                <h5 className="mb-1">{review.user.name}</h5>
                                {/* Assuming the rating property is a number */}
                                <StarRatings
                                    rating={Number(review.rating)}
                                    starRatedColor="gold"
                                    starHoverColor="gold"
                                    starDimension="30"
                                    starSpacing="5"
                                    numberOfStars={5}
                                    name={`rating_${index}`}
                                />
                                <p className="mt-2">{review.review}</p>
                            </div>
                        </div>
                    </div>
                ))
            ): null }

            {/*  remove comment if not auth*/}
            {!window.auth &&(
                <div className="mt-3">
                    <div className="">
                        <h3>Write review </h3>
                        <h5 className="text-muted text-center mt-5">Login to write review</h5>
                    </div>
                </div>
            )}
            {/*                Write Comment*/}
            {window.auth && (
                <div className="mt-3">
                        <div className="">
                            <h3>Write review </h3>
                            <input type="hidden" name="_token" value={''} />
                            <StarRatings
                                rating={Number(rating)} // or Number(rating)
                                starRatedColor="gold"
                                starHoverColor="gold"
                                starDimension="30"
                                starSpacing="5"
                                changeRating={(newRating) => setRating(newRating)}
                                numberOfStars={5}
                            />

                            <div className="d-flex align-items-center justify-content-start mt-2">
                                         <textarea
                                             placeholder="Write Comment About The Product"
                                             cols={100}
                                             rows={3}
                                             defaultValue={""}
                                             name="review"
                                             onChange={(event =>setReview(event.target.value)  )}
                                             id='text-review'
                                         />
                                <button className="btn btn-info text-white ms-3" disabled={disableReview} onClick={()=>( makeReview()

                               )
                                } >
                                    <i className="fa-solid fa-paper-plane" />
                                </button>
                            </div>
                        </div>
                </div>
            )}
        </div>
    );
};

