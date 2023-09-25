<?php

namespace App\Controller;

use App\Entity\Assessments;
use App\Entity\Inspectors;
use App\Entity\Jobs;
use App\Entity\Locations;
use App\Entity\Schedules;
use DateTime;
use DateTimeZone;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class BackendTestController extends AbstractController
{
    // /**
    //   * @Route("/api/backend_test", name="app_backend_test", methods={"POST"})
    //  * @Operation(
    //  *     summary="Summary of your endpoint",
    //  *     @SWG\Parameter(
    //  *         name="inspector_name",
    //  *         in="query",
    //  *         type="string",
    //  *         description="Three names are avaible in database : First Inspector, Second Inspector, Third Inspector> every of them have diferect location."
    //  *     ),
    //  * @SWG\Parameter(
    //  *         name="job_title",
    //  *         in="query",
    //  *         type="string",
    //  *         description="Three jobs are avaible in database : First Job Title, Second Job Title, Third Job Title"
    //  *     ),
    //  * @SWG\Parameter(
    //  *         name="comment",
    //  *         in="query",
    //  *         type="text",
    //  *         description="Write a feedback"
    //  *     ),
    //  *     @SWG\Response(
    //  *         response=200,
    //  *         description="Success"
    //  *     ),
    //  *     @Security(name="Bearer")
    //  * )
    //  */
    #[Route('/backend_test', name: 'app_backend_test', methods: 'POST')]
    public function index(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        $inspectorName = $request->query->get('inspector_name');
        $inspector = $doctrine->getRepository(Inspectors::class)->findOneBy(array('name' => $inspectorName));
        if (!$inspector) {
            throw $this->createNotFoundException('Inspector not found!');
        }
        $inspectorId = $inspector->getId();

        $jobTitle = $request->query->get('job_title');
        $job = $doctrine->getRepository(Jobs::class)->findOneBy(array('title' => $jobTitle));
        if (!$job) {
            throw $this->createNotFoundException('Job not found!');
        }
        $jobId = $job->getId();

        $locationId = $inspector->location->getId();

        // get the current time based on location
        $currentTime = BackendTestController::dateTime($locationId, $doctrine);

        $findInspector = $entityManager->getRepository(Inspectors::class)->find($inspectorId);
        $findJob = $entityManager->getRepository(Jobs::class)->find($jobId);

        // create new schedule
        $schedule = new Schedules;
        $schedule->setInspector($findInspector);
        $schedule->setJob($findJob);
        $schedule->setDate($currentTime);
        $schedule->setCompleted(true);

        $entityManager->persist($schedule);
        $entityManager->flush();

        $findSchedule = $entityManager->getRepository(Schedules::class)->find($schedule->getId());

        if (!$request->query->get('comment')) {
            throw $this->createNotFoundException('Please add a comment!');
        }
        // create new assessment
        $assessment = new Assessments;
        $assessment->setSchedule($findSchedule);
        $assessment->setComments($request->query->get('comment'));

        $entityManager->persist($assessment);
        $entityManager->flush();

        $data = [
            "schedule_id" => $schedule->getId(),
            "inspector_name" => $inspectorName,
            "completed" => $schedule->isCompleted(),
            "date" => $schedule->getDate(),
            "job_title" => $jobTitle,
            "assessment" => $assessment->getId(),
            "comment" => $request->query->get('comment')
        ];

        return $this->json($data);
    }

    private function dateTime($locationId, $doctrine)
    {
        $location = $doctrine->getRepository(Locations::class)->findOneBy(array('id' => $locationId));
        $locationName = $location->getName();

        if ($locationName == "Madrid") {
            return new DateTime('now', new DateTimeZone('Europe/Madrid'));
        } elseif ($locationName == "Mexico City") {
            return new DateTime('now', new DateTimeZone('America/Mexico_City'));
        } else {
            return new DateTime('now', new DateTimeZone('Europe/London'));
        }
    }
}
