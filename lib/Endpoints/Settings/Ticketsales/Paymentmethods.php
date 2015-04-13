<?php
namespace Ticketmatic\Endpoints\Settings\Ticketsales;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Model\CreatePaymentMethod;
use Ticketmatic\Model\PaymentMethod;
use Ticketmatic\Model\PaymentMethodParameters;
use Ticketmatic\Model\UpdatePaymentMethod;

/**
 * A payment method defines the method of an actual payment. Each payment is done by a specific
 * payment method.
 *
 * In the payment method, the type and if appropriate the technical parameters for performing the
 * payment are defined. These parameters depend on the payment gateway used.
 *
 * Not all payment methods can be used in all contexts.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_paymentmethods).
 */
class Paymentmethods
{

    /**
     * Get a list of payment methods
     *
     * @param PaymentMethodParameters|array $params
     *
     * @throws ClientException
     *
     * @return ListPaymentMethod[]
     */
    public static function getlist(Client $client, $params) {
        if (is_array($params)) {
            $params = new PaymentMethodParameters($params);
        }

    }

    /**
     * Get a single payment method
     *
     * @param int $id
     *
     * @throws ClientException
     *
     * @return PaymentMethod
     */
    public static function get(Client $client, $id) {


    }

    /**
     * Create a new payment method
     *
     * @param CreatePaymentMethod|array $data
     *
     * @throws ClientException
     *
     * @return PaymentMethod
     */
    public static function create(Client $client, $data) {
        if (is_array($data)) {
            $data = new CreatePaymentMethod($data);
        }

    }

    /**
     * Modify an existing payment method
     *
     * @param int $id
     *
     * @param UpdatePaymentMethod|array $data
     *
     * @throws ClientException
     *
     * @return PaymentMethod
     */
    public static function update(Client $client, $id, $data) {
        if (is_array($data)) {
            $data = new UpdatePaymentMethod($data);
        }

    }

    /**
     * Remove a payment method
     *
     * Payment methods are archivable: this call won't actually delete the object from the database.
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


    }

    /**
     * Batch modify payment methods
     *
     * @throws ClientException
     */
    public static function batch(Client $client) {


    }

}
