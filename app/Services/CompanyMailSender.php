<?php


namespace App\Services;


use App\Company;
use App\Repositories\CompaniesRepository;
use App\Repositories\UsersRepository;
use App\Structures\MailSenderResponse;
use App\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class CompanyMailSender
{
    /** @var UsersRepository */
    private $userRepository;

    /** @var CompaniesRepository */
    private $companiesRepository;

    public function __construct(UsersRepository $usersRepository, CompaniesRepository $companiesRepository)
    {
        $this->userRepository = $usersRepository;
        $this->companiesRepository = $companiesRepository;
    }

    /**
     * @param int $companyId
     * @param int $userId
     * @return MailSenderResponse
     */
    public function sendNotificationToCompanyEmail(int $companyId, int $userId): MailSenderResponse
    {
        /** @var User|null $user */
        $user = $this->userRepository->find($userId);
        /** @var Company|null $company */
        $company = null;

        if ($companyId > 0) {
            $company = $this->companiesRepository->find($companyId);
        } elseif (!is_null($user)) {
            $user->company_id = null;
            $user->save();
        }

        $response = new MailSenderResponse($user, $company);

        if (is_null($user) || is_null($company)) {
            return $response;
        }

        $toName = $company->name;
        $toEmail = $company->email;
        $data = array('name'=> $user->name, "body" => "was successfully joined to company");
        Mail::send('emails.mail', $data, function(Message $message) use ($toName, $toEmail) {
            $message->to($toEmail, $toName)->subject('Notification about joining to our company');
            $message->from('pandemic428@gmail.com','Notification');
        });

        $user->company_id = $company->id;
        $user->save();
        $response->user = $user;

        return $response;
    }
}
