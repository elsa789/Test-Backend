# Test-Backend

- This is the API: http://localhost:8000/api/backend_test. This api create a schedule, makes a job as completed (true) and creates a assessment with a comment
- The api contains three parameters: inspector_name, job_title, comment. These parameters are mandatory. For testing reasions I have already inserted three inspectors in different locations and three jobs.
   The names of the inspectors : First Inspector located in Madrid, Second Inspector located in Mexico City, Third Inspector located in UK
   The names of the jobs: First Job, Second Job, Third Job
- API with params: http://localhost:8000/api/backend_test?inspector_name=First Inspector&job_title=Second Job Title&comment=Put some comment here!
- Method POST
- This object will be returned:
  {
    "schedule_id": 25,
    "inspector_name": "Second Inspector",
    "completed": true,
    "date": {
        "date": "2023-09-25 13:33:19.157006",
        "timezone_type": 3,
        "timezone": "America/Mexico_City"
    },
    "job_title": "Second Job Title",
    "assessment_id": 18,
    "comment": "Put some comment here!"

}
- Also i have uploaded the database


# Swagger
- I have installed NelmioApiDocBundle using composer require nelmio/api-doc-bundle command
-   /**
      * @Route("/api/backend_test", name="app_backend_test", methods={"POST"})
     * @Operation(
     *     summary="Summary of your endpoint",
     *     @SWG\Parameter(
     *         name="inspector_name",
     *         in="query",
     *         type="string",
     *         description="Three names are avaible in database : First Inspector, Second Inspector, Third Inspector> every of them have diferect location."
     *     ),
     * @SWG\Parameter(
     *         name="job_title",
     *         in="query",
     *         type="string",
     *         description="Three jobs are avaible in database : First Job Title, Second Job Title, Third Job Title"
     *     ),
     * @SWG\Parameter(
     *         name="comment",
     *         in="query",
     *         type="text",
     *         description="Write a feedback"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @Security(name="Bearer")
     * )
     */
  - This code will be commented because it causes an error where I am working on this error
  - The annotation &quot;@Operation&quot; in method App\Controller\BackendTestController::index() was never imported. This is the error even though I have added : use Swagger\Annotations as SWG;
   
