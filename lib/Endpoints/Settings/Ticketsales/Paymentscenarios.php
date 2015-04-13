<?php
namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\CreatePaymentScenario;
use Ticketmatic\Model\PaymentScenario;
use Ticketmatic\Model\PaymentScenarioParameters;
use Ticketmatic\Model\UpdatePaymentScenario;

/**
 * A payment scenario defines how a customer will pay for an order. This is not necessarily linked
 * to a specific payment. When a customer selects a payment scenario for an order, a process is
 * started. The actual process depends on the type of payment scenario:
 *
 * *  Immediate payment: in this case, the payment must be executed immediately by using one of
 * the payment methods that is linked to the payment scenario.
 *
 * *  Deferred payment: in this case, the payment can be executed later and the order can be
 * confirmed without payment. You can configure overdue and expiry parameters to define how long
 * the order can stay unpaid before considering the order as overdue or expired and sending out
 * reminder mails or even cancelling the order automatically
 *
 * An order fee can defined for a payment scenario: this fee will automatically be added to the
 * order when the payment scenario is selected.false
 *
 * A payment scenario is available for one or more sales channels. A custom script can further
 * refine when the payment scenario is available.
 *
 * Examples include: Credit card, Bank transfer, Cash
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_paymentscenarios).
 */
class Paymentscenarios
{

    /**
     * Get a list of payment scenarios
     *
     * @param PaymentScenarioParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListPaymentScenario[]
     */
    public static function getlist(Client $client, $params) {
        if ($params == null || is_array($params)) {
            $params = new PaymentScenarioParameters($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/paymentscenarios");

        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);
        $req->addQuery("filter", $params->filter);

        $result = $req->run();
        return Json::unpackArray("ListPaymentScenario", $result);
    }

    /**
     * Get a single payment scenario
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return PaymentScenario
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/ticketsales/paymentscenarios/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return PaymentScenario::fromJson($result);
    }

    /**
     * Create a new payment scenario
     *
     * @param CreatePaymentScenario|array $data
     *
     * @throws ClientException
     *
     * @return PaymentScenario
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $data = new CreatePaymentScenario($data == null ? array() : $data);
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/ticketsales/paymentscenarios");
        $req->setBody($data);

        $result = $req->run();
        return PaymentScenario::fromJson($result);
    }

    /**
     * Modify an existing payment scenario
     *
     * @param int $id
     *
     * @param UpdatePaymentScenario|array $data
     *
     * @throws ClientException
     *
     * @return PaymentScenario
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $data = new UpdatePaymentScenario($data == null ? array() : $data);
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/paymentscenarios/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return PaymentScenario::fromJson($result);
    }

    /**
     * Remove a payment scenario
     *
     * Payment scenarios are archivable: this call won't actually delete the object from the database.
     * Instead, it will mark the object as archived, which means it won't show up anymore in most
     * places.
     *
     * Most object types are archivable and can't be deleted: this is needed to ensure consistency of
     * historical data.
     *
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/ticketsales/paymentscenarios/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Batch modify payment scenarios
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/ticketsales/paymentscenarios");

        $req->run();
    }
}
